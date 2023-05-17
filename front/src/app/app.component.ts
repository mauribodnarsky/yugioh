import { Component,OnInit,DoCheck  } from '@angular/core';
import { ApiService } from './api.service';
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit,DoCheck {
  title = 'Yu Gi Oh';
  loggedIn=this.apiService.getIsLoggedIn()      
  constructor(private apiService: ApiService) {
    this.loggedIn=this.apiService.getIsLoggedIn()      


  }
 ngDoCheck(){
  this.loggedIn=this.apiService.getIsLoggedIn()      

 }
  ngOnInit() {
    if( localStorage.getItem('token')===undefined){
      this.apiService.setIsLoggedIn(false)      

    }
    this.apiService.getToken().subscribe(
      data=>{

if(data===false){
  this.apiService.setIsLoggedIn(false)      

}else{
  this.apiService.setIsLoggedIn(true)      

}    

      },
      error=>{

        this.apiService.setIsLoggedIn(false)      

        }
    )
   

  }
 
}