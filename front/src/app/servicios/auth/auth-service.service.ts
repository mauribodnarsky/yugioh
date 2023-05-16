import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { tap } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private API_URL = 'http://localhost:8000/api';
  private token: string;

  constructor(private http: HttpClient) {}

  login(email: string, password: string): Observable<any> {
    const url = `${this.API_URL}/login`;
    return this.http.post(url, { email, password }).pipe(
      tap(response => {
        if (response && response.token) {
          localStorage.setItem('access_token', response.token);
          this.token = response.token;
        }
      })
    );
  }

  logout(): void {
    localStorage.removeItem('access_token');
    this.token = null;
  }

  getToken(): string {
    if (!this.token) {
      this.token = localStorage.getItem('access_token');
    }
    return this.token;
  }

  isLoggedIn(): boolean {
    return !!this.getToken();
  }
}
