import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { catchError, map } from 'rxjs';
import { environment } from 'src/environments/environment';
import { CustomHttpResponse } from '../../models/custom-http-response';
import { HandleErrorService } from '../handle-error/handle-error.service';

@Injectable({
  providedIn: 'root'
})
export class DepartmentService {
  private apiPath: string = environment.apiBaseURLV1+'/department'

  constructor(private http: HttpClient, private handleErrorService: HandleErrorService) { }

  getAllDepartments(){
    return this.http.get<CustomHttpResponse>(this.apiPath+'/all').pipe(
      map((response: CustomHttpResponse) => {
        return response;
      }),

      catchError(this.handleErrorService.handleError())
    );
  }
}
