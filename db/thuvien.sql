drop database if exists thuvien;
create database thuvien;
use thuvien;

create table taikhoan(
	id int(10) unsigned not null AUTO_INCREMENT,
    tenDayDu varchar(50) not null,
	tenDN char(10) not null,
	matKhau char(255) not null,
	quyen char(10),
	primary key (id)
);

create table tacGia (
	maTG char(10) not null,
    tenTG varchar(50) not null,
    website varchar(50),
    ghiChu varchar(255),
    primary key (maTG)
);

create table theLoai (
	maTL char(10) not null,
    tenTL varchar(50) not null,
    primary key (maTL)
);

create table nhaXuatBan (
	maNXB char(10) not null,
    tenNXB varchar(50) not null,
    diaChi varchar(100),
    email varchar(50),
    ttNguoiDaiDien varchar(255),
    primary key (maNXB)
);

create table sach (
	maSach char(10) not null,
	tenSach varchar(50), 
    maTG char(10) not null,
    maTL char(10) not null,
    maNXB char(10) not null,
	namXuatBan int, 
	primary key (maSach),
	foreign key (maTG) references tacGia(maTG),
	foreign key (maTL) references theLoai(maTL),
	foreign key (maNXB) references nhaXuatBan(maNXB)
);

create table theThuVien (
	soThe char(10) not null,
    ngayBD date not null,
    ngayKT date not null,
    ghiChu varchar(255),
    primary key (soThe)
);

create table docGia (
	maDG char(10) not null,
    tenDG varchar(50) not null,
    diaChi varchar(100) not null,
    soThe char(10) not null,
    primary key (maDG),
    foreign key (soThe) references theThuVien(soThe)
);


create table nhanVien (
	maNV char(10) not null,
    tenNV varchar(50) not null,
    ngaySinh date,
    soDT int not null,
    primary key (maNV)
);

create table muonTra (
	maMT char(10) not null,
    soThe char(10) not null,
    maNV char(10) not null,
    ngayMuon date not null,
    primary key (maMT),
    foreign key (soThe) references theThuVien(soThe),
    foreign key (maNV) references nhanVien(maNV)
);

create table CTMuonTra (
	maMT char(10) not null,
    maSach char(10) not null,
    ghiChu varchar(255),
    daTra boolean,
    ngayTra date,
    primary key (maMT, maSach),
    foreign key (maMT) references muonTra(maMT),
    foreign key (maSach) references sach(maSach)
);

insert into theloai(maTL, tenTL) values
("TL001", "Công nghệ thông tin"),
("TL002", "Triết học");

insert into tacgia(maTG, tenTG, website, ghiChu) values
("TG001", "Trần Công Án", "abc.com", "Chủ biên"),
("TG002", "Đặng Quốc Bảo", "cde.com", "Chủ biên"),
("TG003", "Nguyễn Ngọc Bình Phương", "fgh.com", "Tổng hợp và biên dịch"),
("TG004", "Bộ Giáo dục và Đào Tạo", "ijk.com", "Bộ");

insert into nhaXuatBan(maNXB, tenNXB, diaChi, email, ttNguoiDaiDien) values
("NXB001", "Nhà xuất bản Đại học Cần Thơ", "Cần Thơ", "nxbdhct@ctu.edu.vn", "Trần Thanh Điện"),
("NXB002", "Nhà xuất bản Giao thông vận tải", "Hà Nội", "nxbgtvt@fpt.vn", "Giao thông vận tải"),
("NXB003", "Nhà xuất bản chính trị quốc gia sự thật", "Cần Thơ", "sachsuthatcantho@gmail.com", "Sự Thật");

insert into sach(maSach, tenSach, maTG, maTL, maNXB, namXuatBan) values
("S001", "Nguyên Lý Hệ quản trị cơ sở dữ liệu", "TG001", "TL001", "NXB001", 2020),
("S002", "Cơ sở dữ liệu", "TG002", "TL001", "NXB001", 2018),
("S003", "Các giải pháp lập trình C#", "TG003", "TL001", "NXB002", 2019),
("S004", "Giáo trình Tư tưởng Hồ Chí Minh", "TG004", "TL002", "NXB003", 2021),
("S005", "Giáo trình Chủ nghĩa xã hội và khoa học", "TG004", "TL002", "NXB003", 2021);

insert into theThuVien(soThe, ngayBD, ngayKT, ghiChu) values
("ST001", "2023-6-30", "2024-6-30", ""),
("ST002", "2023-12-3", "2024-8-27","");

insert into docGia(maDG, tenDG, diaChi, soThe) values
("DG001", "Nguyễn Văn Hậu", "Vĩnh Long", "ST001"),
("DG002", "Lê Thi Trà My", "Cần Thơ", "ST002");

insert into nhanVien(maNV, tenNV, ngaySinh, SoDT) values
("NV001", "Nguyễn Tường Vy", "2000-6-4", 0123456789),
("NV002", "Trần Thanh Nam", "1998-8-24", 0234567128);

insert into muonTra(maMT, soThe, maNV, ngayMuon) values 
("MT001", "ST001", "NV002", "2024-2-4"),
("MT002", "ST001", "NV001", "2024-3-4"),
("MT003", "ST002", "NV001", "2024-3-1");

insert into CTMuonTra(maMT, maSach, ghiChu, daTra, ngayTra) values
("MT001", "S001", "", "1", "2024-2-24"),
("MT001", "S004", "", "1", "2024-2-24"),
("MT002", "S001", "", "0", null),
("MT003", "S001", "", "1", "2024-3-20");

insert into taikhoan (tenDayDu, tenDN, matKhau, quyen) values
("admin", "admin", "$2y$10$mU8tZDU1HqS6czuX2P/KBuZK13.HhtzTVosfeY2noQuEVt.fk0PvO", "admin"),
("lê trâm", "tramle", "$2y$10$1diHoR18InmIAUVsz4ppY.Ydcd5KKllkqDs60PqymiCahbwjUUODK", "");

-- Hiển thị thông tin sách
delimiter //
drop procedure if exists hthiSach//
create procedure hthiSach ()
begin
    select s.maSach, s.tenSach, tg.tenTG, tl.tenTL, nxb.tenNXB, s.namXuatBan
    from sach s
    join theLoai tl on s.maTL = tl.maTL
    join tacGia tg on s.maTG = tg.maTG
    join nhaXuatBan nxb on s.maNXB = nxb.maNXB;
end //
delimiter ;

call hthiSach();

-- hiển thị thông tin sách với mã sách tương được chọn
delimiter //
drop procedure if exists hthiThongTinSach//
create procedure hthiThongTinSach (in_maSach char(10))
begin
    select s.maSach, s.tenSach, tg.tenTG, tl.tenTL, nxb.tenNXB, s.namXuatBan
    from sach s
    join theLoai tl on s.maTL = tl.maTL
    join tacGia tg on s.maTG = tg.maTG
    join nhaXuatBan nxb on s.maNXB = nxb.maNXB
    where maSach = in_maSach;
end //
delimiter ;


-- cập nhật sách
delimiter //
drop function if exists capNhatSach//
create function capNhatSach(
    in_masach char(10),
    in_tensach varchar(50),
    in_tentacgia varchar(50),
    in_tentheloai varchar(50),
    in_tennxb varchar(50),
    in_namxuatban int
)
returns boolean
begin
    declare v_matacgia char(10);
    declare v_matheloai char(10);
    declare v_manxb char(10);

    -- Lấy mã tác giả từ tên tác giả
    select maTG into v_matacgia from tacGia where tenTG = in_tentacgia;

    -- Lấy mã thể loại từ tên thể loại
    select maTL into v_matheloai from theLoai where tenTL = in_tentheloai;

    -- Lấy mã nhà xuất bản từ tên nhà xuất bản
    select maNXB into v_manxb from nhaXuatBan where tenNXB = in_tennxb;

    -- Kiểm tra ràng buộc và trả về false nếu bất kỳ biến nào là null
    if v_matacgia is null or v_matheloai is null or v_manxb is null then
        return false;
    end if;

    -- Cập nhật thông tin sách
    update sach 
    set tenSach = in_tensach, 
        maTG = v_matacgia, 
        maTL = v_matheloai, 
        maNXB = v_manxb, 
        namXuatBan = in_namxuatban 
    where maSach = in_masach;

    -- Kiểm tra số dòng bị ảnh hưởng để xác nhận cập nhật thành công
    if row_count() > 0 then
        return true;
    else
        return false;
    end if;
end //
delimiter ;


delimiter //
drop function if exists themSach//
create function themSach(
    in_masach char(10),
    in_tensach varchar(50),
    in_tentacgia varchar(50),
    in_tentheloai varchar(50),
    in_tennxb varchar(50),
    in_namxuatban int
)
returns boolean
begin
    declare v_matacgia char(10);
    declare v_matheloai char(10);
    declare v_manxb char(10);
    declare count_exist int;

    -- Lấy mã tác giả từ tên tác giả
    select maTG into v_matacgia from tacGia where tenTG = in_tentacgia;

    -- Lấy mã thể loại từ tên thể loại
    select maTL into v_matheloai from theLoai where tenTL = in_tentheloai;

    -- Lấy mã nhà xuất bản từ tên nhà xuất bản
    select maNXB into v_manxb from nhaXuatBan where tenNXB = in_tennxb;

    -- Kiểm tra mã sách tồn tại
    select count(*) into count_exist from sach where maSach = in_masach;
    
    if count_exist > 0 then
        return false;
    end if;

    -- Kiểm tra ràng buộc và trả về false nếu bất kỳ biến nào là null
    if v_matacgia is null or v_matheloai is null or v_manxb is null then
        return false;
    end if;

    -- Cập nhật thông tin sách
    insert into sach (maSach, tenSach, maTG, maTL, maNXB, namXuatBan)
    values (in_masach, in_tensach, v_matacgia, v_matheloai, v_manxb, in_namxuatban);

    -- Kiểm tra số lượng sách được thêm vào và trả về true nếu thành công
    select count(*) into count_exist from sach where maSach = in_masach;
    if count_exist > 0 then
        return true;
    else
        return false;
    end if;
end //
delimiter ;


select themSach("S007", "Quản trị dữ liệu", "Nguyễn Thị Kim Yến ", "Công nghệ thông tin", "Nhà xuất bản Đại học Cần Thơ", 2018);

delimiter //
drop function if exists xoaSach//
create function xoaSach(in_maSach char(10))
returns boolean
begin
    declare error_occurred int default 0;
    
    -- Kiểm tra ràng buộc trước khi xóa
    declare continue handler for sqlexception set error_occurred = 1;
    delete from sach where maSach = in_maSach;
    
    -- Xử lý lỗi ràng buộc
    if error_occurred then
        return false;
    else
        return true;
    end if;
end //
delimiter ;

-- Sắp xếp sách theo tên
delimiter //
drop procedure if exists sapXepSach//
create procedure sapXepSach ()
begin
    select s.maSach, s.tenSach, tg.tenTG, tl.tenTL, nxb.tenNXB, s.namXuatBan
    from sach s
    join theLoai tl on s.maTL = tl.maTL
    join tacGia tg on s.maTG = tg.maTG
    join nhaXuatBan nxb on s.maNXB = nxb.maNXB
    order by s.tenSach ASC;
end //
delimiter ;


-- Tìm kiếm sách bằng tên sách
delimiter //
drop procedure if exists timKiemSach//
create procedure timKiemSach
(
    in in_tensach varchar(10)
)
begin
    select s.maSach, s.tenSach, tg.tenTG, tl.tenTL, nxb.tenNXB, s.namXuatBan
    from sach s
    join theLoai tl on s.maTL = tl.maTL
    join tacGia tg on s.maTG = tg.maTG
    join nhaXuatBan nxb on s.maNXB = nxb.maNXB
    where  lower(s.tenSach) like concat('%', in_tensach, '%');
end //
delimiter ;

call timKiemSach("Cơ sở");




