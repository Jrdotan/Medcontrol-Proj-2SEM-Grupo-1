<?php
function pagination($total_pages, $page){
    $start_page = max(1, $page - 2);
    $end_page = min($total_pages, $page + 2);
    
    $prev_disabled = ($page == 1) ? 'disabled' : '';
    $next_disabled = ($page >= $total_pages || $total_pages == 0) ? 'disabled' : '';
    
    echo '<li class="page-item ' . $prev_disabled . '">';
    echo '<a class="page-link" href="?page=' . ($page - 1) . '">Anterior</a>';
    echo '</li>';
    
    for ($i = $start_page; $i <= $end_page; $i++) {
        echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
    }
    
    echo '<li class="page-item ' . $next_disabled . '">';
    echo '<a class="page-link" href="?page=' . ($page + 1) . '">Próximo</a>';
    echo '</li>';
}