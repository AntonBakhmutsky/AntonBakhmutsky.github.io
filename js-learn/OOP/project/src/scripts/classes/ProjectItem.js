import DomHelper from "@/scripts/classes/DomHelper";
import Tooltip from "@/scripts/classes/Tooltip";

export default class ProjectItem {
  hasActiveTooltip = false;

  constructor(id, updateProjectListsFunction, type) {
    this.id = id;
    this.updateProjectListsHandler = updateProjectListsFunction;
    this.connectMoreInfoButton();
    this.connectSwitchButton(type);
    this.connectDrag();
  }

  showMoreEventHandler() {
    if (this.hasActiveTooltip) {
      return;
    }
    const projectElement = document.getElementById(this.id);
    const tooltipText = projectElement.dataset.extraInfo;
    const tooltip = new Tooltip(() => this.hasActiveTooltip = false, tooltipText, this.id);
    tooltip.attach();
    this.hasActiveTooltip = true;
  }

  connectDrag() {
    const item = document.getElementById(this.id)
    item.addEventListener('dragstart', event => {
      event.dataTransfer.setData('text/plain', this.id);
      event.dataTransfer.effectAllowed = 'move';
    });

    item.addEventListener('dragend', () => {
      console.log(event)
    });
  }

  connectMoreInfoButton() {
    const projectItemElement = document.getElementById(this.id);
    const moreInfoBtn = projectItemElement.querySelector('button:first-of-type');
    moreInfoBtn.addEventListener('click', this.showMoreEventHandler.bind(this));
  }

  connectSwitchButton(type) {
    const projectItemElement = document.getElementById(this.id);
    let switchButton = projectItemElement.querySelector('button:last-of-type');
    switchButton = DomHelper.clearEventListeners(switchButton);
    switchButton.textContent = type === 'active' ? 'Finish' : 'Activate';
    switchButton.addEventListener('click', this.updateProjectListsHandler.bind(null, this.id));
  }

  update(updateProjectsListFunction, type) {
    this.updateProjectListsHandler = updateProjectsListFunction;
    this.connectSwitchButton(type);
  }
}
