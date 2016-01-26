<?php
/*!
 * Traq Lite
 * Copyright (c) 2009-2016 Jack P.
 * https://github.com/nirix/traq-lite
 *
 * Licensed under the BSD 3-Clause license.
 */

use Traq\Models\Ticket;

$ticket = new Ticket(['status_id' => 1]);

if (Request::$method == 'POST') {
    $ticketId = currentProject()->get('next_ticket_id');

    $ticket->set([
        'ticket_id'    => $ticketId,
        'summary'      => Request::$post['summary'],
        'body'         => Request::$post['body'],
        'project_id'   => currentProject()->get('id'),
        'user_id'      => currentUser()->get('id'),
        'type_id'      => Request::$post['type_id'],
        'status_id'    => Request::$post['status_id'],
        'milestone_id' => Request::$post['milestone_id'],
        'component_id' => Request::$post['component_id']
    ]);


    if ($ticket->validate()) {
        db()->beginTransaction();

        $query = db()->prepare('
            INSERT INTO '.PREFIX.'tickets
            (ticket_id, summary, body, project_id, user_id, type status_id, milestone_id, component_id, created_at)
            VALUES (:ticket_id, :summary, :body, :project_id, :user_id, :type :status_id, :milestone_id, :component_id, NOW())
        ');

        $query->bindValue(':ticket_id', $ticket['ticket_id'], PDO::PARAM_INT);
        $query->bindValue(':summary', $ticket['summary']);
        $query->bindValue(':body', $ticket['body']);
        $query->bindValue(':project_id', $ticket['project_id'], PDO::PARAM_INT);
        $query->bindValue(':user_id', $ticket['user_id'], PDO::PARAM_INT);
        $query->bindValue(':type_id', $ticket['type_id'], PDO::PARAM_INT);
        $query->bindValue(':status_id', $ticket['status_id'], PDO::PARAM_INT);
        $query->bindValue(':milestone_id', $ticket['milestone_id'], PDO::PARAM_INT);
        $query->bindValue(':component_id', $ticket['component_id'] ?: null);

        $query->execute();

        $update = db()->prepare('UPDATE '.PREFIX.'projects SET next_ticket_id = next_ticket_id + 1 WHERE id = ? LIMIT 1');
        $update->bindValue(1, currentProject()->get('id'), PDO::PARAM_INT);
        $update->execute();

        db()->commit();

        return redirect('/' . currentProject()->get('slug') . '/tickets/' . $ticketId);
    }
}

return render('tickets/new.phtml', ['ticket' => $ticket]);
