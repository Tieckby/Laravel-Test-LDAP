import { Component, HostListener, OnInit } from '@angular/core';
import { EnumRole } from 'src/app/core/models/enum-role';
import { LocalStorageService } from 'src/app/core/services/local-storage/local-storage.service';
import { adminRoutes } from './sidenav-items';

@Component({
  selector: 'app-sidenav',
  templateUrl: './sidenav.component.html',
  styleUrls: ['./sidenav.component.css']
})
export class SidenavComponent implements OnInit {
  public sideBarItems!: any[];

  public isSidebarOpen: boolean = true;
  public isMobileSidebarOpen: boolean = false;
  public enabledBarIcon: boolean = true;
  public isSubMenuOpen: boolean = false;

  @HostListener('window:resize', ['$event'])
    getScreenSize() {
      if (window.innerWidth <= 640) {
        this.isSidebarOpen = false;
        this.enabledBarIcon = true;
        return;
      }

      this.isSidebarOpen = true;
      this.isMobileSidebarOpen = false;
      return;
    }

  constructor(private _localStorage: LocalStorageService) { }

  ngOnInit(): void {
    this.getScreenSize();
    let roles = this._localStorage.getRoles();
    let _roles = JSON.parse(roles ?? '');

    if (_roles[0].roleName === EnumRole.ADMIN) {
      this.sideBarItems = adminRoutes;
      console.log(this.sideBarItems);
      return;
    }
  }

  onClickMobileBarMenu(): void {
    this.isMobileSidebarOpen = !this.isMobileSidebarOpen;
    this.enabledBarIcon = !this.enabledBarIcon;
  }

  onClickMobileMenuItem(): void {
    this.isMobileSidebarOpen = false;
    this.enabledBarIcon = true;
  }

  onClickSubMenu(): void {
    this.isSubMenuOpen = !this.isSubMenuOpen;
  }
}
