import { Component, Inject, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';

@Component({
  selector: 'app-add-update-employee',
  templateUrl: './add-update-employee.component.html',
  styleUrls: ['./add-update-employee.component.css']
})
export class AddUpdateEmployeeComponent implements OnInit {
  public employeeForm!: FormGroup;
  public hidePassword: boolean = true;

  constructor(private formBuilder: FormBuilder, private dialogRef: MatDialogRef<AddUpdateEmployeeComponent>,
    @Inject(MAT_DIALOG_DATA) public data: any) {}

  ngOnInit(): void {
    if (this.data.action === 'add') {
      this.employeeForm = this.formBuilder.group({
        'fullName': ['', [Validators.required, Validators.minLength(3), Validators.maxLength(50)]],
        'username': ['', [Validators.required, Validators.minLength(3), Validators.maxLength(50), Validators.pattern(/^[a-zA-Z0-9_]+$/)]],
        'email': ['', [Validators.required, Validators.pattern(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/)]],
        'phoneNumber': ['', [Validators.required, Validators.minLength(8), Validators.maxLength(20), Validators.pattern(/^\+[0-9]{8,20}$/)]],
        'password': ['', [Validators.required, Validators.minLength(8), Validators.maxLength(50), Validators.pattern(/^((?=.*\d)(?=.*[a-zA-Z])(?=.*[a-z])(?=.*[A-Z])(?=.*[.@#$%&*~!?_-]).{8,})$/)]],
        'departement': ['', [Validators.required]],
        'role': ['', [Validators.required]],
      });
      return;
    }

    if (this.data.action === 'update'){
      this.employeeForm = this.formBuilder.group({
        'fullName': [this.data.employeeData.fullName, [Validators.required, Validators.minLength(3), Validators.max(50)]],
        'username': [this.data.employeeData.username, [Validators.required, Validators.minLength(3), Validators.maxLength(50), Validators.pattern(/^[a-zA-Z0-9_]+$/)]],
        'email': [this.data.employeeData.email, [Validators.required, Validators.pattern(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/)]],
        'phoneNumber': [this.data.employeeData.phoneNumber, [Validators.required, Validators.minLength(8), Validators.maxLength(20), Validators.pattern(/^\+[0-9]{8,20}$/)]],
        'departement': ['', [Validators.required]],
        'role': ['', [Validators.required]],
      });
      return;
    }
  }


  onSubmit() {
    console.log(this.employeeForm.value);

  }

  onCancel() {
    this.dialogRef.close();
  }
}
