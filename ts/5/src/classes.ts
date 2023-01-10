abstract class Department {
  // private name: string
  protected employees: string[] = []

  protected constructor(protected readonly id: string, public name: string) {
    // this.id = id
    // this.name = name
  }

  static createEmployee(name: string) {
    return {name: name}
  }

  abstract describe(this: Department): void

  addEmployee(employee: string) {
    this.employees.push(employee)
  }

  printEmployeeInformation() {
    console.log(this.employees.length)
    console.log(this.employees)
  }
}

class ITDepartment extends Department {
  constructor(id: string, public admins: string[]) {
    super(id, 'IT');
    this.admins = admins
  }

  describe() {
    console.log('IT Department ID ' + this.id)
  }
}

class AccountingDepartment extends Department {
  private lastReport: string
  private static instance: AccountingDepartment

  get mostRecentReport() {
    if (this.lastReport) {
      return this.lastReport
    }
    throw new Error('No report found.')
  }

  set mostRecentReport(value: string) {
    if (!value) {
      throw new Error('Please pass in a valid value')
    }
    this.addReport(value)
  }

  private constructor(id: string, private reports: string[]) {
    super(id, 'Accounting')
    this.lastReport = reports[0]
  }

  static getInstance() {
    if (this.instance) {
      return this.instance
    }
    this.instance = new AccountingDepartment('d2',  [])
    return this.instance
  }

  describe() {
    console.log('Department ID: ' + this.id)
  }

  addEmployee(name: string) {
    if (name === 'Max') {
      return
    }
    this.employees.push(name)
  }

  addReport(text: string) {
    this.reports.push(text)
    this.lastReport = text
  }

  printReports() {
    console.log(this.reports)
  }
}

// const accounting = new AccountingDepartment('d2',  [])
const accounting = AccountingDepartment.getInstance()
const accounting2 = AccountingDepartment.getInstance()
console.log(accounting, accounting2)

accounting.describe()

accounting.addEmployee('Max')
accounting.addEmployee('Tony')

accounting.addReport('Something went wrong...')
console.log(accounting.mostRecentReport)
accounting.printReports()

accounting.describe()
accounting.printEmployeeInformation()

const it = new ITDepartment('d1',  ['Max'])

it.addEmployee('Max')
it.addEmployee('Tony')

it.describe()
it.printEmployeeInformation()


