import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { catchError, map} from 'rxjs';
import { environment } from 'src/environments/environment';
import { CustomHttpResponse } from '../../models/custom-http-response';
import { HandleErrorService } from '../handle-error/handle-error.service';
import { LocalStorageService } from '../local-storage/local-storage.service';
import { CustomToastService } from '../toast/custom-toast.service';

@Injectable({
  providedIn: 'root'
})
export class EmployeeService {
  private apiPath: string = environment.apiBaseURLV1+'/employee'

  constructor(private http: HttpClient, private toast: CustomToastService,
    private router: Router, private handleErrorService: HandleErrorService,
    private _localStorage: LocalStorageService) {}

  adAutoSign() {
    return this.http.get('http://portal/api/test', {withCredentials: true});
  }

  adSignIn(username: string, password: string){
    let formData = new FormData();
    formData.append('username', username);
    formData.append('password', password);

    return this.http.post('http://portal/api/login', formData);
  }

  signIn(usernameOrEmailOrPhoneNumber: string, password: string) {
    let formData = new FormData();
    formData.append('usernameOrEmailOrPhoneNumber', usernameOrEmailOrPhoneNumber);
    formData.append('password', password);

    return this.http.post<CustomHttpResponse>(this.apiPath+'/signin', formData).pipe(
      map((response: CustomHttpResponse) => {
        if (response.status_code === 200) {
          this.toast.showSuccessMessage(response.message);

          //Store token in local storage
          this._localStorage.setItem('token', response.result.token);
          this._localStorage.setItem('roles', JSON.stringify(response.result.roles));

          this.router.navigate(['/admin-dashbord']);
        }

        return response;
      }),
      catchError(this.handleErrorService.handleError())
    );
  }

  signout() {
    this._localStorage.removeToken();
    this.router.navigate(['/login']);
  }

  getAllEmployees(){
    return this.http.get<CustomHttpResponse>(this.apiPath+'/all').pipe(
      map((response: CustomHttpResponse) => {
        return response;
      }),
      catchError(this.handleErrorService.handleError())
    );
  }
}
