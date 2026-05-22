<?php
// Version without SQLite/PDO: data is stored in JSON files in the data/ folder.
// Works even if the pdo_sqlite driver is not enabled in PHP.

define('DATA_DIR', __DIR__ . '/../data');

function h(?string $value): string { return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8'); }
function redirect(string $url): never { header('Location: ' . $url); exit; }

function data_file(string $name): string { return DATA_DIR . '/' . $name . '.json'; }

function default_reasons(): array {
    return [
        ['id'=>1,'name'=>'Computer is not working'],
        ['id'=>2,'name'=>'Internet issue'],
        ['id'=>3,'name'=>'Printer issue'],
        ['id'=>4,'name'=>'Software issue'],
        ['id'=>5,'name'=>'Consultation needed'],
        ['id'=>6,'name'=>'Access / password / account'],
        ['id'=>7,'name'=>'Technical information protection'],
        ['id'=>8,'name'=>'Other'],
    ];
}

function init_storage(): void {
    if (!is_dir(DATA_DIR)) mkdir(DATA_DIR, 0777, true);
    foreach (['users'=>[], 'requests'=>[]] as $name=>$default) {
        $file = data_file($name);
        if (!file_exists($file)) file_put_contents($file, json_encode($default, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
    }
    $reasons = data_file('reasons');
    if (!file_exists($reasons)) file_put_contents($reasons, json_encode(default_reasons(), JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
}

function load_data(string $name): array {
    init_storage();
    $json = file_get_contents(data_file($name));
    $data = json_decode($json, true);
    return is_array($data) ? $data : [];
}
function save_data(string $name, array $data): void {
    init_storage();
    file_put_contents(data_file($name), json_encode(array_values($data), JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT), LOCK_EX);
}
function next_id(array $items): int { return $items ? max(array_map(fn($x)=>(int)$x['id'], $items)) + 1 : 1; }
function find_by_id(array $items, int $id): ?array { foreach ($items as $item) if ((int)$item['id']===$id) return $item; return null; }
function delete_by_id(array $items, int $id): array { return array_values(array_filter($items, fn($x)=>(int)$x['id']!==$id)); }

function users_all(): array { $u=load_data('users'); usort($u, fn($a,$b)=>strcmp($a['full_name']??'', $b['full_name']??'')); return $u; }
function reasons_all(): array { $r=load_data('reasons'); usort($r, fn($a,$b)=>strcmp($a['name']??'', $b['name']??'')); return $r; }
function requests_all(): array { $r=load_data('requests'); usort($r, fn($a,$b)=>strcmp($b['requested_at']??'', $a['requested_at']??'')); return $r; }

function request_rows(): array {
    $users=load_data('users'); $reasons=load_data('reasons'); $rows=[];
    foreach (requests_all() as $r) {
        $u=find_by_id($users, (int)($r['user_id']??0)) ?: [];
        $rs=find_by_id($reasons, (int)($r['reason_id']??0)) ?: [];
        $r['full_name']=$u['full_name'] ?? 'Unknown user';
        $r['office']=$u['office'] ?? '';
        $r['department']=$u['department'] ?? '';
        $r['reason']=$rs['name'] ?? 'Unknown reason';
        $rows[]=$r;
    }
    return $rows;
}

function month_of(string $dt): string { return substr(str_replace('T',' ', $dt), 0, 7); }
function fmt_dt(?string $dt): string { return $dt ? date('d.m.Y H:i', strtotime(str_replace('T',' ', $dt))) : ''; }
