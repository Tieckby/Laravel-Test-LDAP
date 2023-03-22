import { Component, OnInit, AfterViewInit, ViewChild } from '@angular/core';
import { MatPaginator } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';

@Component({
  selector: 'app-my-demande',
  templateUrl: './my-demande.component.html',
  styleUrls: ['./my-demande.component.css']
})
export class MyDemandeComponent implements OnInit, AfterViewInit{
  public displayedColumns: string[] = ['motif', 'comment', 'period', 'status', 'actions'];
  public dataSource = new MatTableDataSource([
    {
      'motif': "2",
      'comment': "dtdftdghydrytryus dtudtyiutirjnouytuoy retyurt",
      'period': "dtdftdghydr ytryusdtudtyiutirjnouytuoy retyurt",
      'status': "dtdftdghydrytryusdtu dtyiutirjnouytuoy retyurt",
    },
    {
      'motif': "Hellc",
      'comment': "dtdfd458yiuti825 retyurt",
      'period': "dtdftdghydr ytryusdtudtyiutirjnouytuoy retyurt",
      'status': "dtdfusdtu dtyiutirjnouytuoy retyurt",
    },
    {
      'motif': "2",
      'comment': "dtd4454",
      'period': "d4564254ft",
      'status': "dftetr6rty4332",
    }
  ]);

  @ViewChild(MatPaginator) paginator!: MatPaginator;
  @ViewChild(MatSort) sort!: MatSort;

  ngOnInit(): void {

  }

  ngAfterViewInit(): void {
    this.dataSource.paginator = this.paginator;
    this.dataSource.sort = this.sort;
  }

  onChange(inputValue: Event): void {
    let filterData = (inputValue.target as HTMLInputElement).value;
    this.dataSource.filter = filterData.trim().toLowerCase();
  }

}
