import { Component } from '@angular/core';
import { ApiService } from 'src/app/api.service';
import { FormGroup, FormControl } from '@angular/forms';
import { AppComponent } from 'src/app/app.component';
import { HomeComponent } from '../home/home.component';
@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {
  loginForm = new FormGroup({
    username: new FormControl(''),
    password: new FormControl('')
  }
  
  );

  constructor(private ApiService:ApiService,private appComponent: AppComponent,private homeComponent: HomeComponent){
  }
  
  
  onSubmit() {
    const username = this.loginForm.get('username')?.value;
    const password = this.loginForm.get('password')?.value;
    this.ApiService.login(username,password).subscribe(
      data => {
        localStorage.setItem("token",data.token)
        localStorage.setItem("user",data.user)
        this.appComponent.loggedIn = true; // setear la propiedad isLoggedIn a true en AppComponent
      
        this.ApiService.getAllCards().subscribe(
          data => {
            
            
              this.homeComponent.cartas= data.response
          },
          error => {
            console.log(error);
          }
        );
      },
      error => {
        console.log(error);
      }
    );
  }
  
}