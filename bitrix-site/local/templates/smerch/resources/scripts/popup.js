BX.PopupButton = function (params) {
	BX.PopupButton.superclass.constructor.apply(this, arguments);

	this.buttonNode = BX.create(
		"span",
		{
			props: {className: (this.className.length > 0 ? this.className : ""), id: this.id},
			events: this.contextEvents,
			html: '<span>' + this.text + '</span>'
		}
	);
};
BX.extend(BX.PopupButton, BX.PopupWindowButton);

BX.PopupWindow.prototype.setTitle = function (title) {
	if (!this.titleBar) {
		return;
	}

	this.titleBar.innerHTML = ""
	this.titleBar.appendChild(
		BX.create("div", {
				html: title,
				props: {className: 'popup-window-title'}
			}
		))
}

BX.PopupWindow.prototype.setText = function (text) {
	if (!this.contentContainer || !text) {
		return;
	}

	BX.cleanNode(this.contentContainer);
	this.contentContainer.appendChild(BX.create('p', {html: text}));
}
