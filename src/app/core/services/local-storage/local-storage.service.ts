import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class LocalStorageService {

  constructor() { }

  /**
   *
   * Set Item In Local Storage
   *
   */
  setItem(key: string, value: string): void {
    localStorage.setItem(key, value);
  }

  /**
   *
   * Get Item In Local Storage
   *
   */
  getItem(key: string): string | null {
    return localStorage.getItem(key);
  }

  /**
   *
   * Remove Item In Local Storage
   *
   */
  removeItem(key: string): void {
    localStorage.removeItem(key);
  }

  /**
   *
   * Token Getter and Setter
   *
   */
  getToken(): string | null {
    return this.getItem('token');
  }

  removeToken(): void {
    return this.removeItem('token');
  }

  /**
   *
   * Roles Getter and Setter
   *
   */
  getRoles(): string | null {
    return this.getItem('roles');
  }

  removeRoles(): void {
    return this.removeItem('roles');
  }
}
