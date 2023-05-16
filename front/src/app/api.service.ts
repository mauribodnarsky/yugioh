import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { tap, map } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  private baseUrl = 'http:///127.0.0.1:8000/api/';
  private token: string | null = null;

  constructor(private http: HttpClient) { 
    this.token = localStorage.getItem('token');
  }
  login(email: string, password: string): Observable<any> {
    const headers = new HttpHeaders().set('Content-Type', 'application/json');
    const options = { headers: headers };

    const body = {
      email: email,
      password: password
    };

    return this.http.post(`${this.baseUrl}user/login`, body, options);
  }
  createCard(form: FormData): Observable<any> {
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${this.token}`
      })
    };
  
    return this.http.post(`${this.baseUrl}cards`, form, httpOptions);
  }
  editCard(form: FormData): Observable<any> {
    const httpOptions = {
      headers: new HttpHeaders({
        
        'Authorization': `Bearer ${this.token}`
      })
    };
  
    return this.http.post(`${this.baseUrl}cards/update`, form, httpOptions);
  }
  deleteCard(id: any): Observable<any> {
    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${this.token}`
      })
    };
  
    return this.http.delete(`${this.baseUrl}cards/delete/`+id, httpOptions);
  }
  getTypeCards(): Observable<any> {
    const httpOptions = {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${this.token}` // agregar el token en el encabezado Authorization
      })
    };
    return this.http.get<any>(`${this.baseUrl}type_cards`, httpOptions);
  }
  getAllCards(): Observable<any> {
    this.token = localStorage.getItem('token');

    const httpOptions = {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${this.token}` // agregar el token en el encabezado Authorization
      })
    };
    return this.http.get<any>(`${this.baseUrl}cards`, httpOptions);
  }
  searchCard(search :FormData): Observable<any> {
    this.token = localStorage.getItem('token');

    const httpOptions = {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${this.token}` // agregar el token en el encabezado Authorization
      })
    };
    return this.http.post<any>(`${this.baseUrl}cards/search/`,search, httpOptions);
  }
  logout(): void {
    localStorage.removeItem('token');
    this.token = null;
  }

  getToken(): Observable<boolean> {
    if (!this.token) {
      this.token = localStorage.getItem('token');
    }
  
    const httpOptions = {
      headers: new HttpHeaders({
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${this.token}` // agregar el token en el encabezado Authorization
      })
    };
  
    return this.http.get<any>(`${this.baseUrl}user`, httpOptions)
      .pipe(
        map(response => true),
        tap(result => {
        })
      );
  }
  }

