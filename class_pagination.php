<?php
function getData( $limit = 8, $page = 1 ) {
    
    $this->_limit   = $limit;
    $this->_page    = $page;
    if ( $this->_limit == 'all' ) {
        $query      = $this->_query;
    } else {
        $query      = $this->_query . " LIMIT " . ( ( $this->_page - 1 ) * $this->_limit ) . ", $this->_limit";
    }
    $rs             = $this->_conn->query( $query );
    while ( $row = $rs->fetch_assoc() ) {
        $results[]  = $row;
    }
    $result         = new stdClass();
    $result->page   = $this->_page;
    $result->limit  = $this->_limit;
    $result->total  = $this->_total;
    $result->data   = $results;
    return $result;
}

function createLinks( $links, $list_class ) {
    if ( $this->_limit == 'all' ) {
        return '';
    }
    $last       = ceil( $this->_total / $this->_limit );
    $start      = ( ( $this->_page - $links ) > 0 ) ? $this->_page - $links : 1;
    $end        = ( ( $this->_page + $links ) < $last ) ? $this->_page + $links : $last;
    $html       = '<ul class="' . $list_class . '">';
    $class      = ( $this->_page == 1 ) ? "disabled" : "";
    $html       .= '<li class="' . $class . '"><a href="?limit=' . $this->_limit . '&page=' . ( $this->_page - 1 ) . '">&laquo;</a></li>';
    if ( $start > 1 ) {
        $html   .= '<li><a href="?limit=' . $this->_limit . '&page=1">1</a></li>';
        $html   .= '<li class="disabled"><span>...</span></li>';
    }
    for ( $i = $start ; $i <= $end; $i++ ) {
        $class  = ( $this->_page == $i ) ? "active" : "";
        $html   .= '<li class="' . $class . '"><a href="?limit=' . $this->_limit . '&page=' . $i . '">' . $i . '</a></li>';
    }
    if ( $end < $last ) {
        $html   .= '<li class="disabled"><span>...</span></li>';
        $html   .= '<li><a href="?limit=' . $this->_limit . '&page=' . $last . '">' . $last . '</a></li>';
    }
    $class      = ( $this->_page == $last ) ? "disabled" : "";
    $html       .= '<li class="' . $class . '"><a href="?limit=' . $this->_limit . '&page=' . ( $this->_page + 1 ) . '">&raquo;</a></li>';
    $html       .= '</ul>';
    return $html;
}

?>
<html>
    <head>
        <title>PHP Pagination</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
                <div class="col-md-10 col-md-offset-1">
                <h1>PHP Pagination</h1>
                <table class="table table-striped table-condensed table-bordered table-rounded">
                        <thead>
                                <tr>
                                <th>City</th>
                                <th width="20%">Country</th>
                                <th width="20%">Continent</th>
                                <th width="25%">Region</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                </table>
                </div>
        </div>
        </body>
</html>
<?php for( $i = 0; $i < count( $results->data ); $i++ ) : ?>
        <tr>
                <td><?php echo $results->data[$i]['kd_brg']; ?></td>
                <td><?php echo $results->data[$i]['kd_jenis']; ?></td>
                <td><?php echo $results->data[$i]['kd_merek']; ?></td>
                <td><?php echo $results->data[$i]['Region']; ?></td>
				
        </tr>
<?php endfor; 
  require_once 'paginator_class.php';
    $conn       = new mysqli( '127.0.0.1', 'root', '', 'sjm' );
    $limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 25;
    $page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
    $links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;
    $query      = "SELECT * FROM barang";
    $Paginator  = new Paginator( $conn, $query );
    $results    = $Paginator->getData( $page, $limit );

?>

<?php echo $Paginator->createLinks( $links, 'pagination pagination-sm' ); ?> 