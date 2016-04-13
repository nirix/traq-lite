<?php
$milestone = db()->prepare('
    SELECT * FROM '.PREFIX.'milestones WHERE slug = ? AND project_id = ? LIMIT 1
');
$milestone->bindValue(1, Request::$properties->get('slug'));
$milestone->bindValue(2, currentProject()['id'], PDO::PARAM_INT);
$milestone->execute();
return view('roadmap/show.phtml', ['milestone' => $milestone->fetch()]);
