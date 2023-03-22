import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AdminDashbordComponent } from '../admin/admin-dashbord/admin-dashbord.component';
import { AllDemandesComponent } from '../admin/all-demandes/all-demandes.component';
import { DepartementComponent } from '../admin/departement/departement.component';
import { EmployeeComponent } from '../admin/employee/employee.component';
import { HelloTestComponent } from '../hello-test/hello-test.component';
import { ProfileComponent } from '../profile/profile.component';
import { MyDemandeComponent } from './components/my-demande/my-demande.component';

const routes: Routes = [
  {
    path: 'admin-dashbord',
    component: AdminDashbordComponent,
  },

  {
    path: 'department',
    component: DepartementComponent,
  },

  {
    path: 'employee',
    component: EmployeeComponent,
  },

  {
    path: 'my-demande',
    component: MyDemandeComponent,
  },

  {
    path: 'all-demandes',
    component: AllDemandesComponent,
  },

  {
    path: 'profile',
    component: ProfileComponent,
  },
  {
    path: 'test',
    component: HelloTestComponent,
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class SharedRoutingModule { }
