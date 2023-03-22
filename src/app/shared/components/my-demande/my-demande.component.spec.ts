import { ComponentFixture, TestBed } from '@angular/core/testing';

import { MyDemandeComponent } from './my-demande.component';

describe('MyDemandeComponent', () => {
  let component: MyDemandeComponent;
  let fixture: ComponentFixture<MyDemandeComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ MyDemandeComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(MyDemandeComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
