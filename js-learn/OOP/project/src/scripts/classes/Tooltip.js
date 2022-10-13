export default class Tooltip {
  detach = () => {
    this.element.remove();
  }

  show() {
    const tooltipElement = document.createElement('div');
    tooltipElement.className = 'card';
    tooltipElement.textContent = 'DUMMY!';
    tooltipElement.addEventListener('click', this.detach);
    this.element = tooltipElement;
    document.body.append(tooltipElement);
  }
}
