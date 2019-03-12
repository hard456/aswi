<h1>Search in texts - Results</h1>

<?php
while($SearchText->next_record()) {
    $res = $SearchText->getResult();

$this->render_element('search-text');

}
    ?>