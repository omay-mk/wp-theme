<form class="form-inline my-2 my-lg-0" action="<?= esc_url(home_url/* Retrieves the URL.*/('/'))?>">
      <input class="form-control mr-sm-2" name="s" type="search" placeholder="recherche" aria-label="Search" value= "<?= get_search_query() /*Retrieves the contents of the search WP query variable */?>">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
    </form>