(function() {
	'use strict';

	if (!!window.JCCatalogSectionComponent)
		return;

	window.JCCatalogSectionComponent = function(params) {
		this.formPosting = false;
		this.siteId = params.siteId || '';
		this.ajaxId = params.ajaxId || '';
		this.template = params.template || '';
		this.componentPath = params.componentPath || '';
		this.parameters = params.parameters || '';

		if (params.navParams)
		{
			this.navParams = {
				NavNum: params.navParams.NavNum || 1,
				NavPageNomer: parseInt(params.navParams.NavPageNomer) || 1,
				NavPageCount: parseInt(params.navParams.NavPageCount) || 1
			};
		}

		this.container = document.querySelector('[data-entity="' + params.container + '"]');
		this.showMoreButton = null;
		this.showMoreButtonMessage = null;

		if (params.deferredLoad)
		{
			BX.ready(BX.delegate(this.deferredLoad, this));
		}

		if (params.lazyLoad)
		{
			this.showMoreButton = document.querySelector('[data-use="show-more-' + this.navParams.NavNum + '"]');
			this.showMoreButtonMessage = this.showMoreButton.innerHTML;
			BX.bind(this.showMoreButton, 'click', BX.proxy(this.showMore, this));
		}
	};

	window.JCCatalogSectionComponent.prototype =
	{
		checkButton: function()
		{
			if (this.showMoreButton)
			{
				if (this.navParams.NavPageNomer == this.navParams.NavPageCount)
				{
					BX.remove(this.showMoreButton);
				}
				else
				{
					this.container.parent.appendChild(this.showMoreButton);
				}
			}
		},

		enableButton: function()
		{
			if (this.showMoreButton)
			{
				BX.removeClass(this.showMoreButton, 'disabled');
				this.showMoreButton.innerHTML = this.showMoreButtonMessage;
			}
		},

		disableButton: function()
		{
			if (this.showMoreButton)
			{
				BX.addClass(this.showMoreButton, 'disabled');
				this.showMoreButton.innerHTML = '<button>' + BX.message('BTN_MESSAGE_LAZY_LOAD_WAITER') + '</button>';
			}
		},

		loadOnScroll: function()
		{
			var scrollTop = BX.GetWindowScrollPos().scrollTop,
				containerBottom = BX.pos(this.container).bottom;

			if (scrollTop + window.innerHeight > containerBottom)
			{
				this.showMore();
			}
		},

		showMore: function()
		{
			if (this.navParams.NavPageNomer < this.navParams.NavPageCount)
			{
				var data = {};
				data['action'] = 'showMore';
				data['PAGEN_' + this.navParams.NavNum] = this.navParams.NavPageNomer + 1;

				if (!this.formPosting)
				{
					this.formPosting = true;
					this.disableButton();
					this.sendRequest(data);
				}
			}
		},

		deferredLoad: function()
		{
			this.sendRequest({action: 'deferredLoad'});
		},

		sendRequest: function(data)
		{
			var defaultData = {
				siteId: this.siteId,
				template: this.template,
				parameters: this.parameters
			};

			if (this.ajaxId)
			{
				defaultData.AJAX_ID = this.ajaxId;
			}

			BX.ajax({
				url: this.componentPath + '/ajax.php' + (document.location.href.indexOf('clear_cache=Y') !== -1 ? '?clear_cache=Y' : ''),
				method: 'POST',
				dataType: 'json',
				timeout: 60,
				data: BX.merge(defaultData, data),
				onsuccess: BX.delegate(function(result){
					if (!result || !result.JS)
						return;

					BX.ajax.processScripts(
						BX.processHTML(result.JS).SCRIPT,
						false,
						BX.delegate(function(){this.showAction(result, data);}, this)
					);
				}, this)
			});
		},

		showAction: function(result, data)
		{
			if (!data)
				return;

			switch (data.action)
			{
				case 'showMore':
					this.processShowMoreAction(result);
					break;
				case 'deferredLoad':
					this.processDeferredLoadAction(result, data.bigData === 'Y');
					break;
			}
		},

		processShowMoreAction: function(result)
		{
			this.formPosting = false;
			this.enableButton();

			if (result)
			{
				this.navParams.NavPageNomer++;
				this.processItems(result.items);
				this.processPagination(result.pagination);
				this.processEpilogue(result.epilogue);
				this.checkButton();
			}
		},

		processDeferredLoadAction: function(result, bigData)
		{
			if (!result)
				return;

			var position = bigData ? this.bigData.rows : {};

			this.processItems(result.items, BX.util.array_keys(position));
		},

		processItems: function(itemsHtml, position)
		{
			if (!itemsHtml)
				return;

			var processed = BX.processHTML(itemsHtml, false),
				temporaryNode = BX.create('DIV');

			var items, k, origRows;

			temporaryNode.innerHTML = processed.HTML;console.log(temporaryNode)
			items = temporaryNode.querySelectorAll('[data-entity="item"]');

			if (items.length)
			{
				for (k in items)
				{
					if (items.hasOwnProperty(k))
					{
						items[k].style.opacity = 0;
						this.container.appendChild(items[k]);
					}
				}

				new BX.easing({
					duration: 1000,
					start: {opacity: 0},
					finish: {opacity: 100},
					transition: BX.easing.makeEaseOut(BX.easing.transitions.quad),
					step: function(state){
						for (var k in items)
						{
							if (items.hasOwnProperty(k))
							{
								items[k].style.opacity = state.opacity / 100;
							}
						}
					},
					complete: function(){
						for (var k in items)
						{
							if (items.hasOwnProperty(k))
							{
								items[k].removeAttribute('style');
							}
						}
					}
				}).animate();
			}

			BX.ajax.processScripts(processed.SCRIPT);
		},

		processPagination: function(paginationHtml)
		{
			if (!paginationHtml)
				return;

			var pagination = document.querySelectorAll('[data-pagination-num="' + this.navParams.NavNum + '"]');
			for (var k in pagination)
			{
				if (pagination.hasOwnProperty(k))
				{
					pagination[k].innerHTML = paginationHtml;
				}
			}
		},

		processEpilogue: function(epilogueHtml)
		{
			if (!epilogueHtml)
				return;

			var processed = BX.processHTML(epilogueHtml, false);
			BX.ajax.processScripts(processed.SCRIPT);
		},
	};
})();
