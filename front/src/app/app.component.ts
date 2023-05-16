import { Component } from '@angular/core';
import { ApiService } from './api.service';
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'Yu Gi Oh';
  public loggedIn = false;

  constructor(private apiService: ApiService) {}

  ngOnInit() {
    const token = this.apiService.getToken().subscribe(
      data=>{
        this.loggedIn = true;

      },
      error=>{
        if (error.status === 401) {
          this.loggedIn = false;
        }      }
    )
   

  }
  ngOnChanges() {
    const token = this.apiService.getToken().subscribe(
      data=>{
        this.loggedIn = true;

      },
      error=>{
        if (error.status === 401) {
          this.loggedIn = false;
        }      }
    )
   

  }
}