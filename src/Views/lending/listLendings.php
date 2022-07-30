<div class="list-books">
    <table class="algn-center-horizontal">
        <thead>
            <th>Nome do livro</th>
        </thead>
        <tbody>
            <?php
                use Michel\Projeto\Models\Lendings;

                $results = Lendings::listLendings($_SESSION['userid']);
                while($res = $results->fetchArray()){
                    echo "<tr><td>" . $res['title'] . "</td></tr>";
                }
            ?>
        </tbody>
    </table>
</div>