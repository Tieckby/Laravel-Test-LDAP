import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ForgotPasswordComponent } from './forgot-password/forgot-password.component';
import { LoginComponent } from './login/login.component';
import { SharedComponent } from './shared/shared.component';
import { TesthomeComponent } from './testhome/testhome.component';

const routes: Routes = [
  {
    path: "testhome",
    component: TesthomeComponent
  },

  {
    path: "login",
    component: LoginComponent
  },

  {
    path: '',
    redirectTo: 'login',
    pathMatch: 'full'
  },

  {
    path: "forgot-password",
    component: ForgotPasswordComponent
  },

  {
    path: '',
    component: SharedComponent,
    children: [
      {
        path: '',
        loadChildren: () => import('./shared/shared.module').then(_shared => _shared.SharedModule)
      }
    ],
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
