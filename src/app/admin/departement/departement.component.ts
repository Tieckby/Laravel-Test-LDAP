import { Component, ViewChild, OnInit, AfterViewInit } from '@angular/core';
import { MatDialog } from '@angular/material/dialog';
import { MatPaginator } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { DepartmentService } from 'src/app/core/services/department/department.service';
import { AddUpdateDepartmentComponent } from './dialogs/add-update-department/add-update-department.component';

@Component({
  selector: 'app-departement',
  templateUrl: './departement.component.html',
  styleUrls: ['./departement.component.css']
})
export class DepartementComponent implements OnInit, AfterViewInit{
  public allDepartments: any;
  public displayedColumns: string[] = ['name', 'created_date', 'actions'];
  public dataSource = new MatTableDataSource([]);

  @ViewChild(MatPaginator) paginator!: MatPaginator;
  @ViewChild(MatSort) sort!: MatSort;

  constructor(private departmentService: DepartmentService, private dialog: MatDialog) {}

  ngAfterViewInit(): void {
    this.dataSource.paginator = this.paginator;
    this.dataSource.sort = this.sort;
  }

  ngOnInit(): void {
    this.departmentService.getAllDepartments().subscribe(
      result => {
        this.allDepartments = result;
        this.dataSource.data = this.allDepartments;
      }
    );
  }

  onChange(inputValue: Event): void {
    let filterData = (inputValue.target as HTMLInputElement).value;
    this.dataSource.filter = filterData.trim().toLowerCase();
  }

  openDialog(action: string, departmentData?: any): void {
    this.dialog.open(AddUpdateDepartmentComponent, {
      data: {
        'action': action,
        'departmentData': departmentData
      }
    });
  }
}
