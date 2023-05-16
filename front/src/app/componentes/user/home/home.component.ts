import { Component, OnInit  } from '@angular/core';
import { ApiService } from 'src/app/api.service';
import {AfterViewInit, ViewChild} from '@angular/core';

export interface Carta {
  id:number,
  atk:string,
  def:string,
  code: string,
  name: string,
  description: string,
  image: null,
  price: number,
  stars: number,
  id_type_card:number,
  id_subtype_card:number,
  
  type_card:any,
  subtype_card:any,
}

export interface TypeCard {
  name: string,
  id:number,
}

export interface SubTypeCard {
  name: string,
  id:number,
  id_type_card:number,

}
@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit ,AfterViewInit  {
  public types_cards: any[] = [];
  public subtypes_cards: any[] = [];
  public subtypes_cards_selected: any[] = [];
  public cartas: Carta[] = [];
  public busqueda: string = '';

  currentPage: number = 1;
  pageSize: number = 4;
  
  totalItems: any = this.cartas.length;
   type_card_edit:any={
  "name":"",
  "id":null
 }
 subtype_card_edit:any={
  "name":"",
  "id":null,
  "id_type_card":null

 }
  newCard: any = {

    atk:'',
    def:'',
    code: '',
    name: '',
    description: '',
    image: null,
    price: '',
    stars: '',
    id_type_card:this.type_card_edit.id,
    id_subtype_card:this.subtype_card_edit.id,
    type_card:this.type_card_edit,
    subtype_card:this.subtype_card_edit,
    };
    CardEdit: any = {
      id:'',

      atk:'',
      def:'',
      code: '',
      name: '',
      description: '',
      image: null,
      price: '',
      stars: '',
      id_type_card:this.type_card_edit.id,
      id_subtype_card:this.subtype_card_edit.id,
      type_card:this.type_card_edit,
      subtype_card:this.subtype_card_edit,
      };
      
    CardView: any = {
      id:'',

      atk:'',
      def:'',
      code: '',
      name: '',
      description: '',
      image: null,
      price: '',
      stars: '',
      id_type_card:this.type_card_edit.id,
      id_subtype_card:this.subtype_card_edit.id,
      type_card:this.type_card_edit,
      subtype_card:this.subtype_card_edit,
      };
      CardDelete: any = {
        id:null,

        atk:'',
        def:'',
        code: '',
        name: '',
        description: '',
        image: null,
        price: '',
        stars: '',
        id_type_card:this.type_card_edit.id,
        id_subtype_card:this.subtype_card_edit.id,
        type_card:this.type_card_edit,
        subtype_card:this.subtype_card_edit,
        };

  selectedFile: File | null = null;

  showModal = false;
  constructor(private ApiService:ApiService) { 
    this.ApiService.getAllCards().subscribe(
      data => {
        

          this.cartas= data.response
      },
      error => {
        console.log(error);
      }
    );
  }
  getTotalPages(): number {
    return Math.ceil(this.cartas.length / this.pageSize);
  }
  getStarsArray(stars: number): number[] {
    console.log(stars)
    stars=Math.round(stars)
    return Array(stars).fill(0).map((_, index) => index + 1);
  }
  getPages(): number[] {
    const totalPages = this.getTotalPages();
    return Array(totalPages)
      .fill(0)
      .map((_, index) => index + 1);
  }

  ngAfterViewInit() {
    this.ApiService.getAllCards().subscribe(
      data => {
        
      this.cartas= data.response
      },
      error => {
        console.log(error);
      }
    );
  }
  onFileSelected(event: any) {
    const files = (event.target as HTMLInputElement).files;
    if (files && files.length > 0) {
      this.newCard.image = files[0];

    }  }
    onFileSelectedEdit(event: any) {
      const files = (event.target as HTMLInputElement).files;
      if (files && files.length > 0) {
        this.CardEdit.image = files[0];
  
      }
      console.log(this.CardEdit.image)

    }
  ngOnInit(): void {
    this.ApiService.getAllCards().subscribe(
      data => {
        
      this.cartas= data.response
      },
      error => {
        console.log(error);
      }
    );
    this.ApiService.getTypeCards().subscribe(
      data => {
        this.types_cards= data.types
        this.subtypes_cards= data.subtypes

      },
      error => {
        console.log(error);
      }
    );

  }
  editmodal(Card:any){

this.CardEdit=Card    
    }
    
  viewmodal(Card:any){

    this.CardView=Card    
        }
        
  deleteModal(Card:any){
console.log(Card)
    this.CardDelete=Card    
        }


        deleteCard(){

          this.ApiService.deleteCard(this.CardDelete.id).subscribe(

            response => {
              if(response.response==true){
                alert("Carta Eliminada!")
              }
              this.ApiService.getAllCards().subscribe(
                data => {
                    this.cartas= data.response
                },
                error => {
                  console.log(error);
                }
              );          
              },
            error => {
              console.error(error);
            }
          );
        
        }


  saveCard(){
    const formData = new FormData();


  formData.append('atk', this.newCard.atk);
  formData.append('def', this.newCard.def);
  formData.append('code', this.newCard.code);
  formData.append('name', this.newCard.name);
  formData.append('description', this.newCard.description);
  formData.append('image', this.newCard.image);
  formData.append('price', this.newCard.price);
  formData.append('stars', this.newCard.stars);
  formData.append('id_type_card', this.newCard.id_type_card);
  formData.append('id_subtype_card', this.newCard.id_subtype_card);
 
    this.ApiService.createCard(formData).subscribe(
      response => {
        this.ApiService.getAllCards().subscribe(
          data => {
              this.cartas= data.response
          },
          error => {
            console.log(error);
          }
        );                },
      error => {
        console.error(error);
      }
    );
  
  }
  editCard(){
    const formData = new FormData();

    formData.append('id', this.CardEdit.id);

  formData.append('atk', this.CardEdit.atk);
  formData.append('def', this.CardEdit.def);
  formData.append('code', this.CardEdit.code);
  formData.append('name', this.CardEdit.name);
  formData.append('description', this.CardEdit.description);
  formData.append('image', this.CardEdit.image);
  formData.append('price', this.CardEdit.price);
  formData.append('stars', this.CardEdit.stars);
  formData.append('id_type_card', this.CardEdit.id_type_card);
  formData.append('id_subtype_card', this.CardEdit.id_subtype_card);
 
    this.ApiService.editCard(formData).subscribe(
      response => {
        this.ApiService.getAllCards().subscribe(
          data => {
              this.cartas= data.response
          },
          error => {
            console.log(error);
          }
        );                },
      error => {
        console.error(error);
      }
    );
  
  }



  searchCard(){
    const formData = new FormData();

    formData.append('search', this.busqueda);
    console.log(this.busqueda);

    this.ApiService.searchCard(formData).subscribe(
          data => {
              this.cartas= data.response
          },
          error => {
            console.log(error);
          }
    );
  
  }
  openModal() {
    this.showModal = true;
  }

  closeModal() {
    this.showModal = false;
    this.newCard = {
      atk: '',
      def: '',
      code: '',
      name: '',
      description: '',
      image: '',
      price: '',
      stars: '',
      id_type_card:'',
      id_subtype_card:''
}
this.CardView = {
  atk: '',
  def: '',
  code: '',
  name: '',
  description: '',
  image: '',
  price: '',
  stars: '',
  id_type_card:'',
  id_subtype_card:''
}   
 this.CardEdit = {
  atk: '',
  def: '',
  code: '',
  name: '',
  description: '',
  image: '',
  price: '',
  stars: '',
  id_type_card:'',
  id_subtype_card:''
}
  
  }

  updatesubtypes(id :any){

      this.subtypes_cards_selected = this.subtypes_cards.filter(
        (subtype) => subtype.id_type_card == id
      );
  }
}

