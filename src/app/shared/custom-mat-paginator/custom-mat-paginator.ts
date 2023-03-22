import { MatPaginatorIntl } from '@angular/material/paginator';

export function CustomMatPaginator() {
  let customMatPaginator = new MatPaginatorIntl();

  customMatPaginator.itemsPerPageLabel = "Page par élément"
  customMatPaginator.firstPageLabel = "Première page"
  customMatPaginator.previousPageLabel = "Page précédente"
  customMatPaginator.nextPageLabel = "Page suivante"
  customMatPaginator.lastPageLabel = "Dernière page"

  return customMatPaginator;
}
