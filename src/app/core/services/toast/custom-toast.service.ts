import { Injectable } from '@angular/core';
import { ToastrService } from 'ngx-toastr';

@Injectable({
  providedIn: 'root'
})
export class CustomToastService {

  constructor(private toast: ToastrService) { }

  showSuccessMessage(message: string, title?: string): void {
    this.toast.success(message, title);
  }

  showErrorMessage(message: string, title?: string): void {
    this.toast.error(message, title);
  }

  showWarningMessage(message: string, title?: string): void {
    this.toast.warning(message, title);
  }
}
