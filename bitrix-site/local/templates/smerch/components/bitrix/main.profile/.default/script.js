const YMDdate = document.getElementById('YMDdate')

YMDdate.onchange = () => {
	if (YMDdate.value.length) {
		const date = new Date(YMDdate.value)
		document.getElementById('DMYdate').value = date.toLocaleDateString('ru-RU')
	}
}
