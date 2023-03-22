import { Component, OnInit, AfterViewInit, ViewChild } from '@angular/core';
import { MatDialog } from '@angular/material/dialog';
import { MatPaginator } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { EmployeeService } from 'src/app/core/services/employee/employee.service';
import { AddUpdateEmployeeComponent } from './dialogs/add-update-employee/add-update-employee.component';

@Component({
  selector: 'app-employee',
  templateUrl: './employee.component.html',
  styleUrls: ['./employee.component.css']
})
export class EmployeeComponent implements OnInit, AfterViewInit{
  public allEmployees: any;

  public displayedColumns: string[] = ['fullName', 'email', 'phoneNumber', 'startDate', 'actions'];
  public dataSource = new MatTableDataSource([]);

  @ViewChild(MatPaginator) paginator!: MatPaginator;
  @ViewChild(MatSort) sort!: MatSort;

  constructor(private employeeService: EmployeeService, private dialog: MatDialog) {}

  ngOnInit(): void {
    this.employeeService.getAllEmployees().subscribe(
      result => {
        this.allEmployees = result;
        this.dataSource.data = this.allEmployees;
      }
    );
  }

  ngAfterViewInit(): void {
    this.dataSource.paginator = this.paginator;
    this.dataSource.sort = this.sort;
  }

  onChange(inputValue: Event): void {
    let filterData = (inputValue.target as HTMLInputElement).value;
    this.dataSource.filter = filterData.trim().toLowerCase();
  }

  openDialog(action: string, employeeData?: any): void {
    this.dialog.open(AddUpdateEmployeeComponent, {
      data: {
        'action': action,
        'employeeData': employeeData
      }
    });
  }
}
