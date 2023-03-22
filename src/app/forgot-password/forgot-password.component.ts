import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { CustomToastService } from '../core/services/toast/custom-toast.service';

@Component({
  selector: 'app-forgot-password',
  templateUrl: './forgot-password.component.html',
  styleUrls: ['./forgot-password.component.css']
})
export class ForgotPasswordComponent implements OnInit {
  public forgotPasswordForm!: FormGroup;

  constructor(private formBuilder: FormBuilder, private toast: CustomToastService) { }

  ngOnInit(): void {
    this.forgotPasswordForm = this.formBuilder.group({
      "email": ['', [Validators.required, Validators.email, Validators.pattern(/[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/)]]
    });
  }

  onSubmit(): void {
    console.log(this.forgotPasswordForm.value.email);
    this.toast.showSuccessMessage("Sent....", "Success");
  }

}
