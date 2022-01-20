<?php
function levels() {
    return collect([
        (object) [ "id" => "1", "name" => "Super admin"],
        (object) [ "id" => "2", "name" => "Admin"],
        (object) [ "id" => "3", "name" => "editor"]
    ]);
}

function types() {
    return collect([
        (object) [ "id" => "1", "name" => "Phiếu thu"],
        (object) [ "id" => "2", "name" => "Phiếu chi"],
        (object) [ "id" => "3", "name" => "Phiếu rút"]
    ]);
}

function loaidichvus() {
    return collect([
        (object) [ "id" => "1", "name" => "Dịch vụ"],
        (object) [ "id" => "2", "name" => "Cài máy"],
        (object) [ "id" => "3", "name" => "Kiểm tra"],
        (object) [ "id" => "4", "name" => "Bảo hành"],
        (object) [ "id" => "5", "name" => "Chưa xác định"],
    ]);
}

function congnos() {
    return collect([
        (object) [ "id" => "0", "name" => "Không"],
        (object) [ "id" => "1", "name" => "Công nợ"],
    ]);
}

function tinhtrangs() {
    return collect([
        (object) [ "id" => "1", "name" => "Đã tiếp nhận", "color" => "primary"],
        (object) [ "id" => "2", "name" => "Đang xử lý", "color" => "success"],
        (object) [ "id" => "3", "name" => "Đã xong", "color" => "danger"],
        (object) [ "id" => "4", "name" => "Đã giao", "color" => "dark"]
    ]);
}
