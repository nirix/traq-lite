<?php
$ticket = db()->prepare('SELECT * FROM '.PREFIX.'tickets WHERE ticket_id = ? AND project_id = ? LIMIT 1');
$ticket->bindValue(1, Request::$properties->get('id'), PDO::PARAM_INT);
$ticket->bindValue(2, currentProject()['id'], PDO::PARAM_INT);
$ticket->execute();
return render('tickets/show.phtml', ['ticket' => $ticket->fetch()]);
