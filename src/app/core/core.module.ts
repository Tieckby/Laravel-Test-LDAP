import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ToastrModule } from 'ngx-toastr';
import { HttpClientModule } from '@angular/common/http';
import { CustomHttpInterceptorProvider } from './interceptors/custom-http.interceptor';



@NgModule({
  declarations: [],
  imports: [
    CommonModule,
    ToastrModule.forRoot(
      {
        preventDuplicates: true,
        closeButton: true
      }
    ),

    HttpClientModule,
  ],
  providers: [
    CustomHttpInterceptorProvider
  ]
})
export class CoreModule { }
