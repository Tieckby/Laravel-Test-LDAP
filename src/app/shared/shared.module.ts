import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { SharedRoutingModule } from './shared-routing.module';
import { SharedComponent } from './shared.component';
import { MatIconModule } from "@angular/material/icon";
import { MatMenuModule } from "@angular/material/menu";
import { MatCardModule } from '@angular/material/card';
import { MatTableModule } from '@angular/material/table';
import { MatPaginatorModule } from "@angular/material/paginator";
import { MatSortModule } from "@angular/material/sort";
import { MatPaginatorIntl } from '@angular/material/paginator';
import { MatDialogModule } from '@angular/material/dialog';
import { ProfileComponent } from '../profile/profile.component';
import { SidenavComponent } from './components/sidenav/sidenav.component';
import { CustomMatPaginator } from './custom-mat-paginator/custom-mat-paginator';
import { HelloTestComponent } from '../hello-test/hello-test.component';
import { AdminDashbordComponent } from '../admin/admin-dashbord/admin-dashbord.component';
import { DepartementComponent } from '../admin/departement/departement.component';
import { AddUpdateDepartmentComponent } from '../admin/departement/dialogs/add-update-department/add-update-department.component';
import { ReactiveFormsModule } from '@angular/forms';
import { MatFormFieldModule } from '@angular/material/form-field';
import { EmployeeComponent } from '../admin/employee/employee.component';
import { AddUpdateEmployeeComponent } from '../admin/employee/dialogs/add-update-employee/add-update-employee.component';
import { MyDemandeComponent } from './components/my-demande/my-demande.component';
import { AllDemandesComponent } from '../admin/all-demandes/all-demandes.component';


@NgModule({
  declarations: [
    SharedComponent,
    SidenavComponent,
    AdminDashbordComponent,
    DepartementComponent,
    AddUpdateDepartmentComponent,
    EmployeeComponent,
    AddUpdateEmployeeComponent,
    MyDemandeComponent,
    AllDemandesComponent,
    ProfileComponent,
    HelloTestComponent,
  ],
  imports: [
    CommonModule,
    SharedRoutingModule,
    ReactiveFormsModule,
    MatFormFieldModule,
    MatIconModule,
    MatMenuModule,
    MatCardModule,
    MatTableModule,
    MatPaginatorModule,
    MatSortModule,
    MatDialogModule
  ],
  providers: [
    {
      provide: MatPaginatorIntl, useValue: CustomMatPaginator()
    }
  ]
})
export class SharedModule { }
