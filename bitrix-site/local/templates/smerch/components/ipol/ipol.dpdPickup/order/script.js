BX.ready(function() {
	const popupContent = BX('DPD_pvz_popup');
		popupContent.style.display = 'block';

	const popup = BX.PopupWindowManager.create('DPD_pvz_popup_window', null, {
			content: popupContent,
			autoHide: false,
			closeByEsc: true,
			closeIcon: true,
			zIndex: 0,
			contentColor: 'white',
			overlay: true,
			contentPadding: null,
			padding: null
		});


	BX.bindDelegate(document, 'click', {className: 'DPD_openTerminalSelect'}, function(event) {
		const componentNode    = BX('DPD_pvz');
		const componentParams  = eval('('+ this.dataset.componentParams +')');
		const componentResult  = eval('('+ this.dataset.componentResult +')');
		const terminalCode     = BX('IPOLH_DPD_TERMINAL').value;

		popup.show();

		componentNode.DpdPickupMap.liveReload(componentParams, componentResult);
		componentNode.DpdPickupMap.highlightTerminal({code: terminalCode, highlightIcon: true});

		saveTerminalInfo(terminalCode);

		return BX.PreventDefault(event)
	});

	BX.addCustomEvent(BX('DPD_pvz'), 'dpdPickup:selectTerminal', function(terminalCode, needUpdate) {

		if (terminalCode) {
			BX('IPOLH_DPD_TERMINAL').value = terminalCode;
		}

		saveTerminalInfo(terminalCode);

		if (needUpdate !== false) {
			(typeof window.submitForm == "function") && setTimeout(submitForm, 500);
			(typeof window.submitFormProxy == "function") && setTimeout(submitFormProxy, 500);

			popup.close();
		}
	});

	function saveTerminalInfo(terminalCode)
	{
		const componentNode     = BX('DPD_pvz')
		const terminalFieldId   = BX('IPOLH_DPD_TERMINAL_FIELD_ID').value;
		const terminalFieldCode = BX('IPOLH_DPD_TERMINAL_FIELD_CODE').value;
		const terminalInfo      = componentNode.querySelector('.DPD_terminalSelect[data-terminal-code="'+ terminalCode +'"]');
		const terminalName      = terminalInfo ? terminalInfo.getAttribute('data-terminal-addr') +' ('+ terminalCode +')' : '';

		const f1 = document.querySelector('*[name="ORDER_PROP_'+ terminalFieldId +'"]');
		const f2 = document.querySelector('*[name="ORDER_PROP_'+ terminalFieldCode +'"]');

		if (f1) {
			f1.value = terminalName;
			f1.setAttribute('readonly', 'readonly')
			f1.style.backgroundColor = '#eee';
		}

		if (f2) {
			f2.value = terminalName;
			f2.setAttribute('readonly', 'readonly')
			f2.style.backgroundColor = '#eee';
		}
	}
});
