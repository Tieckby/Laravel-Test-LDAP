//Admin Route

export const adminRoutes = [
  //Dashbord
  {
    path: '/admin-dashbord',
    icon: 'home',
    title: 'Tableau de bord',
    submenu: []
  },

  //Department
  {
    path: '/department',
    icon: 'apartment',
    title: 'Départements',
    submenu: []
  },

  //Employee
  {
    path: '/employee',
    icon: 'manage_accounts',
    title: 'Employés',
    submenu: []
  },

  //Demandes
  {
    path: '',
    icon: 'contact_support',
    title: 'Demandes',
    submenu: [
      {
        path: '/all-demandes',
        icon: 'forum',
        title: 'Toutes les demandes'
      },

      {
        path: '/my-demande',
        icon: 'forum',
        title: 'Mes demandes'
      },
    ]
  }
];
