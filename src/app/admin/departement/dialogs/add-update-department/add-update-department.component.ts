import { Component, OnInit, Inject } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';

@Component({
  selector: 'app-add-update-department',
  templateUrl: './add-update-department.component.html',
  styleUrls: ['./add-update-department.component.css']
})
export class AddUpdateDepartmentComponent implements OnInit{
  public departmentForm!: FormGroup;

  constructor(private formBuilder: FormBuilder, private dialogRef: MatDialogRef<AddUpdateDepartmentComponent>,
    @Inject(MAT_DIALOG_DATA) public data: any) {}

  ngOnInit(): void {
    if (this.data.action === 'add') {
      this.departmentForm = this.formBuilder.group({
        'name': ['', [Validators.required, Validators.minLength(3), Validators.max(50)]]
      });
      return;
    }

    if (this.data.action === 'update'){
      this.departmentForm = this.formBuilder.group({
        'name': [this.data.departmentData.name, [Validators.required, Validators.minLength(3), Validators.max(50)]]
      });
      return;
    }
  }

  onSubmit() {
    console.log(this.departmentForm.value);

  }

  onCancel() {
    this.dialogRef.close();
  }
}
