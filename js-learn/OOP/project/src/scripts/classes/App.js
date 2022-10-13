import ProjectList from "@/scripts/classes/ProjectList";

export default class App {
  static init() {
    const activeProjectsList = new ProjectList('active');
    const finishedProjectsList = new ProjectList('finished');
    activeProjectsList.setSwitchHandlerFunction(finishedProjectsList.addProject.bind(finishedProjectsList));
    finishedProjectsList.setSwitchHandlerFunction(activeProjectsList.addProject.bind(activeProjectsList));
    // const someScript = document.createElement('script');
    // someScript.textContent = 'alert("Hi there")';
    // document.head.append(someScript);
    this.analytics();
  }
  static analytics() {
    const analyticsScript = document.createElement('script');
    analyticsScript.textContent = 'const intervalId = setInterval(() => {console.log(\'Sending analytics data...\')}, 2000);document.getElementById(\'stop-analytics-btn\').addEventListener(\'click\', () => {clearInterval(intervalId);});';
    analyticsScript.defer = true;
    document.head.append(analyticsScript);
  }
}
