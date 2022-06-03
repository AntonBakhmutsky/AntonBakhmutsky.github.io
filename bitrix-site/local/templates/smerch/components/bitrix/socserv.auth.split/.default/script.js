if (typeof (BX.SocservAuthSplitComponent) === 'undefined') {

	BX.SocservAuthSplitComponent = function (id) {
		this._id = id

		const buttons = BX.findChildrenByClassName(BX(this._id), 'pa__data-socials-cancel')
		for (let i = 0; i < buttons.length; i++)
		{
			if (BX.type.isElementNode(buttons[i])) {
				BX.bind(buttons[i], 'click', BX.delegate(this.delete, this));
			}
		}
	}
	BX.SocservAuthSplitComponent.prototype =
		{
			initialize: function (id) {
				this._id = id
				this.initPopupWindow()
			},
			initPopupWindow: function () {
				this._popup = BX.PopupWindowManager.create(this._id + '_popup', null, {
					autoHide: false,
					closeByEsc: true,
					closeIcon: true,
					className: 'popup-window_mailing',
					contentColor: 'white',
					overlay: true,
					contentPadding: null,
					padding: null,
					titleBar: true
				})
			},
			showConfirmPopup: function (urlToDelete) {
				this._popup.setTitle('Вы точно хотете удалить профиль?\n' +
					'<svg width="267" height="3" viewBox="0 0 267 3" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
					'<path d="M238.037 0.797911C245.181 0.796659 252.325 0.760085 259.165 0.832535C261.75 0.859512 264.184 1.09995 266.466 1.27127C266.77 1.30353 265.709 1.64979 265.406 1.65285C262.822 1.67886 260.238 1.6872 257.806 1.65869C255.373 1.63019 252.94 1.49572 250.508 1.50253C195.183 1.61782 140.008 1.69625 84.6836 1.91751C59.1491 2.01555 33.6176 2.41382 8.08482 2.68847C6.41303 2.70529 4.28566 2.76203 2.91674 2.66983C1.7 2.59377 0.63381 2.37489 0.480063 2.19981C0.478996 2.09384 2.14919 1.91807 3.36433 1.83519C4.4275 1.75384 5.79552 1.75773 7.01137 1.7455C71.7575 1.28812 136.503 0.777758 200.952 0.959225C213.264 0.994267 225.727 0.886494 238.038 0.850893C238.038 0.833232 238.038 0.815572 238.037 0.797911Z"\n' +
					' fill="black"></path>\n' +
					'</svg>')
				this._popup.setButtons([
					new BX.PopupButton({
						text: 'Отмена',
						className: "popup-window-button_approve",
						events: {
							click: function () {
								this.popupWindow.close();
							}
						}
					}),
					new BX.PopupButton({
						text: 'Да, удалить',
						className: "popup-window-button_approve",
						events: {
							click: function () {
								window.location = urlToDelete
							}
						}
					})
				])
				this._popup.show()
			},
			delete: function (event) {
				event.preventDefault()
				event.stopPropagation()
				this.showConfirmPopup(event.target.closest('a.pa__data-socials-cancel').getAttribute("href"))
			}
		}
	BX.SocservAuthSplitComponent.create = function (id) {
		const _self = new BX.SocservAuthSplitComponent(id)
		_self.initialize(id)
		return _self
	};
}
