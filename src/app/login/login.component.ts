import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { EmployeeService } from '../core/services/employee/employee.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  public loginForm!: FormGroup;
  public loading: boolean = false;

  constructor(private formBuilder: FormBuilder, private employeeService: EmployeeService,
    private router: Router) { }

  ngOnInit(): void {
    //Test Active Directory Auto Login
    this.employeeService.adAutoSign().subscribe(
      {
        next: (response: any) => {
          if (response['isLogged']) {
            localStorage.setItem("welcomeMessage", response['welcome']);
            this.router.navigate(['/testhome']);
          }
        },
        error: (error) => {
          console.log(error);
        },
      }
    );

    this.loginForm = this.formBuilder.group({
      // "usernameOrEmailOrPhone": ['', [Validators.required, Validators.minLength(3), Validators.maxLength(50)]],
      // "password": ['', [Validators.required, Validators.minLength(8), Validators.maxLength(50)]]

      "usernameOrEmailOrPhone": ['', [Validators.required, Validators.minLength(3), Validators.maxLength(50)]],
      "password": ['', [Validators.required]]
    });
  }

  onSubmit(): void {
    this.loading = true;
    // this.employeeService.signIn(this.loginForm.value.usernameOrEmailOrPhone, this.loginForm.value.password).subscribe(
    //   res => {
    //     this.loading = false;
    //   }
    // );

    //Test Active Directory Login
    this.employeeService.adSignIn(this.loginForm.value.usernameOrEmailOrPhone, this.loginForm.value.password).subscribe(
      {
        next: (result: any) => {
          localStorage.setItem("welcomeMessage", result['welcome']);
          this.router.navigate(['/testhome']);
          this.loading = false;
        },
        error: (error) => {
          console.log(error);
          this.loading = false;
        }
      }
    );
  }
}
