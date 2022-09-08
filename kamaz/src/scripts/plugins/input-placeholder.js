export default function (inputs) {

  const togglePlaceholder = (e) => {
    const inputValue = e.currentTarget.value.trim();
    const list = e.currentTarget.parentElement.querySelector('span').classList;

    !inputValue && list.contains('active') ? list.remove('active') : list.add('active');
  }

  inputs.forEach(el => el.addEventListener('input', togglePlaceholder))

}
