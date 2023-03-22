import { Injectable } from '@angular/core';
import { of } from 'rxjs';
import { CustomHttpErrorResponse } from '../../models/custom-http-error-response';
import { CustomToastService } from '../toast/custom-toast.service';

@Injectable({
  providedIn: 'root'
})
export class HandleErrorService {

  constructor(private toast: CustomToastService) { }

  public handleError<CustomHttpResponse>() {
    return (error: CustomHttpErrorResponse, response: CustomHttpResponse) => {
      this.toast.showErrorMessage(error.error.message);

      return of(response as CustomHttpResponse);
    };
  }
}
