import Component from "@/scripts/classes/Component";

export default class Tooltip extends Component{
  constructor(closeNotifierFunction, text, hostElementId) {
    super(hostElementId);
    this.closeNotifier = closeNotifierFunction;
    this.text = text;
    this.create();
  }

  closeTooltip = () => {
    this.detach();
    this.closeNotifier();
  }

  create() {
    const tooltipElement = document.createElement('div');
    tooltipElement.className = 'card';
    const tooltipTemplate = document.getElementById('tooltip');
    const tooltipBody = document.importNode(tooltipTemplate.content, true);
    tooltipBody.querySelector('p').textContent = this.text;
    tooltipElement.append(tooltipBody);

    const hostElementPositionLeft = this.hostElement.offsetLeft;
    const hostElementPositionTop = this.hostElement.offsetTop;
    const hostElementPositionHeight = this.hostElement.clientHeight;
    const parentElementScrolling = this.hostElement.parentElement.scrollTop;

    const x = hostElementPositionLeft + 20;
    const y = hostElementPositionTop + hostElementPositionHeight - parentElementScrolling - 10;

    tooltipElement.style.position = `absolute`;
    tooltipElement.style.left = `${x}px`;
    tooltipElement.style.top = `${y}px`;

    tooltipElement.addEventListener('click', this.closeTooltip);
    this.element = tooltipElement;
  }
}
