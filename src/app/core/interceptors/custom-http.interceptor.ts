import { Injectable } from '@angular/core';
import {
  HttpRequest,
  HttpHandler,
  HttpEvent,
  HttpInterceptor,
  HTTP_INTERCEPTORS
} from '@angular/common/http';
import { Observable } from 'rxjs';
import { LocalStorageService } from '../services/local-storage/local-storage.service';

@Injectable()
export class CustomHttpInterceptor implements HttpInterceptor {

  constructor(private _localStorage: LocalStorageService) {}

  intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    let token = this._localStorage.getToken();

    if (token != null) {
      let updateRequest = request.clone({
        headers: request.headers.set('Authorization', 'Bearer '+token)
      });

      return next.handle(updateRequest);
    }

    return next.handle(request);
  }
}


export const CustomHttpInterceptorProvider = {
  provide: HTTP_INTERCEPTORS,
  useClass: CustomHttpInterceptor,
  multi: true
}
