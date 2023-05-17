import { Component } from '@angular/core';
import { ApiService } from 'src/app/api.service';
import { FormGroup, FormControl } from '@angular/forms';
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
  
  constructor(private ApiService:ApiService){
  }
  ngOnInit(){
  }
  
  onSubmit() {
    const username = this.loginForm.get('username')?.value;
    const password = this.loginForm.get('password')?.value;
    this.ApiService.login(username,password).subscribe(
      data => {
        localStorage.setItem("token",data.token)
        localStorage.setItem("user",data.user)
        this.ApiService.setIsLoggedIn(true)      
        this.ApiService.getAllCards().subscribe(
          data => {
            
            
          },
          error => {
            console.log(error);
          }
        );
      },
      error => {
        this.ApiService.setIsLoggedIn(true)      
      
      }
    );
  }
  
}