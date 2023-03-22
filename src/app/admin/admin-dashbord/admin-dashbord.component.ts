import { Component, OnInit, ViewChild, AfterViewInit } from '@angular/core';
import { MatPaginator } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { DepartmentService } from 'src/app/core/services/department/department.service';
import { EmployeeService } from 'src/app/core/services/employee/employee.service';

@Component({
  selector: 'app-admin-dashbord',
  templateUrl: './admin-dashbord.component.html',
  styleUrls: ['./admin-dashbord.component.css']
})
export class AdminDashbordComponent implements OnInit, AfterViewInit{
  public allEmployees: any;
  public allDepartments: any;

  public displayedColumns_1: string[] = ['fullName', 'email', 'phoneNumber', 'startDate'];
  public dataSource_1 = new MatTableDataSource([]);

  public displayedColumns_2: string[] = ['name', 'created_date'];
  public dataSource_2 = new MatTableDataSource([]);

  @ViewChild('paginator_1') paginator_1!: MatPaginator;
  @ViewChild(MatSort) sort_1!: MatSort;

  @ViewChild('paginator_2') paginator_2!: MatPaginator;
  @ViewChild(MatSort) sort_2!: MatSort;

  constructor(private employeeService: EmployeeService, private departmentService: DepartmentService) {}

  ngAfterViewInit(): void {
    this.dataSource_1.paginator = this.paginator_1;
    this.dataSource_1.sort = this.sort_1;

    this.dataSource_2.paginator = this.paginator_2;
    this.dataSource_2.sort = this.sort_2;
  }

  ngOnInit(): void {
    this.employeeService.getAllEmployees().subscribe(
      result => {
        this.allEmployees = result;
        this.dataSource_1.data = this.allEmployees;
      }
    );

    this.departmentService.getAllDepartments().subscribe(
      result => {
        this.allDepartments = result;
        this.dataSource_2.data = this.allDepartments;
      }
    );
  }

}
