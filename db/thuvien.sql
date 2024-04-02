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
	tenSach varchar(50) not null, 
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
    soThe char(10) not null unique,
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
("TL002", "Triết học"),
("TL003", "Khoa học xã hội"),
("TL004", "Khoa học tự nhiên"),
("TL005", "Ngoại ngữ");


insert into tacgia(maTG, tenTG, website, ghiChu) values
("TG001", "Trần Công Án", "abc.com", "Chủ biên"),
("TG002", "Đặng Quốc Bảo", "cde.com", "Chủ biên"),
("TG003", "Nguyễn Ngọc Bình Phương", "fgh.com", "Tổng hợp và biên dịch"),
("TG004", "Bộ Giáo dục và Đào Tạo", "ijk.com", "Bộ"),
("TG005", "Trương Quốc Định", "def.com", "Chủ biên"),
("TG006", "Trần Thành Trai", "ttt.com", "Chủ biên"),
("TG007", "Đào Phương Chi", "", ""),
("TG008", "Đinh Ngọc Thạch", "dnt.com", "Chủ biên"),
("TG009", "Dương Trọng Phúc", "dtp.com", ""),
("TG010", "Nguyễn Khanh Văn", "", "");



insert into nhaXuatBan(maNXB, tenNXB, diaChi, email, ttNguoiDaiDien) values
("NXB001", "Nhà xuất bản Đại học Cần Thơ", "Cần Thơ", "nxbdhct@ctu.edu.vn", "Trần Thanh Điện"),
("NXB002", "Nhà xuất bản Giao thông vận tải", "Hà Nội", "nxbgtvt@fpt.vn", "Giao thông vận tải"),
("NXB003", "Nhà xuất bản chính trị quốc gia sự thật", "Cần Thơ", "sachsuthatcantho@gmail.com", "Sự Thật"),
("NXB004", "Nhà xuất bản Thống kê", "Hà Nội", "nxbtk@gmail.com", "Thống kê"),
("NXB005", "Nhà xuất bản Khoa học xã hội", "Hà Nội", "nxbkhxh@gmail.com", "Khoa học xã hội"),
("NXB006", "Nhà xuất bản Tổng hợp", "Hồ Chí Minh", "tonghop@nxbhcm.com.vn", "Đinh Thị Thanh Thủy"),
("NXB007", "Nhà xuất bản Bách khoa Hà Nội", "Hà Nội", "nxbbk@hust.edu.vn", "Bùi Đức Hùng");

insert into sach(maSach, tenSach, maTG, maTL, maNXB, namXuatBan) values
("S001", "Nguyên Lý Hệ quản trị cơ sở dữ liệu", "TG001", "TL001", "NXB001", 2020),
("S002", "Cơ sở dữ liệu", "TG002", "TL001", "NXB001", 2018),
("S003", "Các giải pháp lập trình C#", "TG003", "TL001", "NXB002", 2019),
("S004", "Giáo trình Tư tưởng Hồ Chí Minh", "TG004", "TL002", "NXB003", 2021),
("S005", "Giáo trình Lịch sử Đảng Cộng sản Việt Nam", "TG004", "TL002", "NXB003", 2021),
("S006", "Giáo trình Chủ nghĩa xã hội và khoa học", "TG004", "TL002", "NXB003", 2021),
("S007", "Giáo trình Kinh tế chính trị Mác-Lênin", "TG004", "TL002", "NXB003", 2021),
("S008", "Giáo trình Triết học Mác-Lênin", "TG004", "TL002", "NXB003", 2021),
("S009", "Giáo trình Phân tích thiết kế hệ thống thông tin", "TG005", "TL001", "NXB001", 2015),
("S010", "Giáo trình Phân tích thiết kế hệ thống thông tin quản lý", "TG006", "TL001", "NXB004", 1994),
("S011", "Giáo trình Anh văn căn bản 1", "TG004", "TL005", "NXB001", 2023),
("S012", "Giáo trình Anh văn căn bản 2", "TG004", "TL005", "NXB001", 2023),
("S013", "Giáo trình Anh văn căn bản 3", "TG004", "TL005", "NXB001", 2023),
("S014", "Giáo trình Hóa học vô cơ", "TG004", "TL004", "NXB001", 2020),
("S015", "Giáo trình Hóa học hữu cơ", "TG004", "TL004", "NXB001", 2020),
("S016", "Giáo trình Hóa học đại cương", "TG004", "TL004", "NXB001", 2021),
("S017", "Văn bản và Hệ sinh thái văn bản", "TG007", "TL003", "NXB005", 2021),
("S018", "Giáo trình triết học phương Tây hiện đại", "TG008", "TL002", "NXB006", 2019),
("S019", "Chân dung Anh hùng Lý Tự Trọng qua những tư liệu lịch sử", "TG009", "TL003", "NXB006", 2024),
("S020", "Giáo trình Pháp văn căn bản 1", "TG004", "TL005", "NXB001", 2022),
("S021", "Giáo trình Pháp văn căn bản 2", "TG004", "TL005", "NXB001", 2022),
("S022", "Giáo trình Pháp văn căn bản 3", "TG004", "TL005", "NXB001", 2022),
("S023", "Giáo trình Cơ sở an toàn thông tin", "TG010", "TL001", "NXB007", 2023),
("S024", "Giáo trình Công nghệ J2EE", "TG001", "TL001", "NXB001", 2019);


insert into theThuVien(soThe, ngayBD, ngayKT, ghiChu) values
("ST001", "2023-6-30", "2024-6-30", ""),
("ST002", "2023-12-3", "2024-8-27", ""),
("ST003", "2023-6-30", "2024-4-30", ""),
("ST004", "2023-12-30", "2024-12-30", ""),
("ST005", "2023-3-2", "2024-12-12", ""),
("ST006", "2023-4-2", "2024-6-2", ""),
("ST007", "2023-9-10", "2024-9-18", ""),
("ST008", "2022-12-1", "2023-11-23", ""),
("ST009", "2024-4-1", "2025-4-1", ""),
("ST010", "2024-3-23", "2024-8-30", "");

insert into docGia(maDG, tenDG, diaChi, soThe) values
("DG001", "Nguyễn Văn Hậu", "Vĩnh Long", "ST001"),
("DG002", "Lê Thị Trà My", "Cần Thơ", "ST002"),
("DG003", "Đoàn Văn Lập", "Trà Vinh", "ST003"),
("DG004", "Lê Xuân Thùy", "Sóc Trăng", "ST004"),
("DG005", "Lư Thị Ngọc Bích", "Cà Mau", "ST005"),
("DG006", "Đỗ Nguyễn Tùng Anh", "An Giang", "ST006"),
("DG007", "Lê Thy", "Bến Tre", "ST007"),
("DG008", "Nguyễn Khánh Thy", "Tiền Giang", "ST008"),
("DG009", "Vũ Văn Sơn", "Kiên Giang", "ST009"),
("DG010", "Trần Nguyễn Thái Ngọc Anh", "Hậu Giang", "ST010");


insert into nhanVien(maNV, tenNV, ngaySinh, SoDT) values
("NV001", "Nguyễn Tường Vy", "2000-6-4", 0123456789),
("NV002", "Trần Thanh Nam", "1998-8-24", 0234567128),
("NV003", "Nguyễn Thế Nhất", "2000-2-28", 0125586681),
("NV004", "Cù Quốc Tuấn", "2001-12-4", 0337600999),
("NV005", "Nguyễn Ngọc Trúc Quỳnh", "2004-5-16", 0856021148);


insert into muonTra(maMT, soThe, maNV, ngayMuon) values 
("MT001", "ST001", "NV002", "2024-2-4"),
("MT002", "ST001", "NV001", "2024-3-4"),
("MT003", "ST002", "NV001", "2024-3-23"),
("MT004", "ST004", "NV001", "2024-3-24"),
("MT005", "ST005", "NV003", "2024-4-1"),
("MT006", "ST008", "NV004", "2023-3-31"),
("MT007", "ST009", "NV005", "2024-4-2");

insert into CTMuonTra(maMT, maSach, ghiChu, daTra, ngayTra) values
("MT001", "S001", "", "1", "2024-2-24"),
("MT001", "S004", "", "1", "2024-2-24"),
("MT002", "S001", "", "0", null),
("MT003", "S002", "", "1", "2024-4-2"),
("MT003", "S005", "", "1", "2024-4-2"),
("MT003", "S019", "", "0", null),
("MT004", "S007", "", "0", null),
("MT004", "S002", "", "0", null),
("MT004", "S003", "", "1", "2024-3-31"),
("MT004", "S004", "", "1", "2024-3-31"),
("MT005", "S008", "", "0", null),
("MT005", "S004", "", "0", null),
("MT006", "S014", "", "1", "2023-10-24"),
("MT006", "S016", "", "1", "2023-10-24"),
("MT007", "S006", "", "0", null),
("MT007", "S003", "", "0", null);


insert into taikhoan (tenDayDu, tenDN, matKhau, quyen) values
("admin", "admin", "$2y$10$mU8tZDU1HqS6czuX2P/KBuZK13.HhtzTVosfeY2noQuEVt.fk0PvO", "admin"),
("lê trâm", "tramle", "$2y$10$1diHoR18InmIAUVsz4ppY.Ydcd5KKllkqDs60PqymiCahbwjUUODK", "");

-- --------------------------------------------------------------------------------
-- Sách
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

-- Thêm sách
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

    -- Thêm thông tin sách
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

-- Xóa sách

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


-- Tìm kiếm sách
delimiter //
drop procedure if exists timKiemSach//
create procedure timKiemSach
(
    in keyword varchar(10)
)
begin
    select s.maSach, s.tenSach, tg.tenTG, tl.tenTL, nxb.tenNXB, s.namXuatBan
    from sach s
    join theLoai tl on s.maTL = tl.maTL
    join tacGia tg on s.maTG = tg.maTG
    join nhaXuatBan nxb on s.maNXB = nxb.maNXB
    where  lower(s.tenSach) like concat('%', keyword, '%')
    or lower(s.maSach) like keyword
    or lower(tg.tenTg) like concat('%', keyword, '%')
    or lower(tl.tenTL) like concat('%', keyword, '%')
    or lower(nxb.tenNXB) like concat('%', keyword, '%');
end //
delimiter ;

-- ----------------------------------------------------------------------------
-- Tác giả
-- Hiển thị Tác giả
delimiter //
drop procedure if exists hthiTG//
create procedure hthiTG ()
begin
    select *
    from tacgia;
end //
delimiter ;

-- hiển thị thông tin sách với mã Tác giả được chọn
delimiter //
drop procedure if exists hthiThongTinTG//
create procedure hthiThongTinTG (in_maTG char(10))
begin
    select *
    from tacgia
    where maTG = in_maTG;
end //
delimiter ;

-- cập nhật tác giả
delimiter //
drop function if exists capNhatTG//
create function capNhatTG(
    in_maTG char(10),
    in_tenTG varchar(50),
    in_website varchar(50),
    in_ghiChu varchar(255)
)
returns boolean
begin
    update tacGia
    set tenTG = in_tenTG,
        website = in_website,
        ghiChu = in_ghiChu
    where maTG = in_maTG;

   if row_count() > 0 then
        return true;
    else
        return false;
    end if;
end //
delimiter ;


-- Thêm Tác giả
delimiter //
drop function if exists themTG//
create function themTG(
    in_maTG char(10),
    in_tenTG varchar(50),
    in_website varchar(50),
    in_ghiChu varchar(255)
)
returns boolean
begin
	DECLARE count_exist int ;
    
    select count(*) into count_exist from tacgia where maTG = in_maTG;
	if count_exist > 0 then
        return false;
    end if;
    -- Cập nhật thông tin Tác giả
    insert into tacgia(maTG, tenTG, website, ghiChu)
    values (in_maTG, in_tenTG, in_website, in_ghiChu);
           
	select count(*) into count_exist from tacgia where maTG = in_maTG;
    if count_exist > 0 then
        return true;
    else
        return false;
    end if;
	
end //
delimiter ;


delimiter //
drop function if exists xoaTG//
create function xoaTG(in_maTG char(10))
returns boolean
begin
    declare error_occurred int default 0;
    
    -- Kiểm tra ràng buộc trước khi xóa
    declare continue handler for sqlexception set error_occurred = 1;
    delete from tacgia where maTG = in_maTG;
    
    -- Xử lý lỗi ràng buộc
    if error_occurred then
        return false;
    else
        return true;
    end if;
end //
delimiter ;


-- Sắp xếp tên tác giả
delimiter //
drop procedure if exists sapXepTG//
create procedure sapXepTG ()
begin
    select  *
    from tacgia
    order by  tenTG ASC;
end //
delimiter ;

-- Tìm kiếm tác giả
delimiter //
drop procedure if exists timKiemTG//
create procedure timKiemTG
(
    in in_tacgia varchar(10)
)
begin
    select  *
    from tacgia
    where  lower(tenTG) like concat('%', in_tacgia, '%')
    or lower(maTG) = lower(in_tacgia) ;
end //
delimiter ;

-- --------------------------------------------------------------------------------
-- Hiển thị Thể loại
delimiter //
drop procedure if exists hthiTL//
create procedure hthiTL ()
begin
    select *
    from theloai ;
end //
delimiter ;

-- hiển thị thông tin sách với mã thể loại được chọn
delimiter //
drop procedure if exists hthiThongTinTL//
create procedure hthiThongTinTL(in_maTL char(10))
begin
    select *
    from theloai
    where maTL = in_maTL;
end //
delimiter ;


-- cập nhật thể loại
delimiter //
drop function if exists capNhatTL//
create function capNhatTL(
    in_maTL char(10),
    in_tenTL varchar(50)
)
returns boolean
begin
	
    update theLoai
    set tenTL = in_tenTL
    where maTL = in_maTL;
	if row_count() > 0 then
        return true;
    else
        return false;
    end if;
end //
delimiter ;

-- Thêm thể loại
delimiter //
drop function if exists themTL//
create function themTL(
    in_maTL char(10),
    in_tenTL varchar(50)
)
returns boolean
begin
	declare count_exist int ;
    
    select count(*) into count_exist from theloai where maTL = in_maTL;
    if count_exist > 0 then
        return false;
	end if;
    
    -- Cập nhật thông tin Tác giả
    insert into theloai(maTL, tenTL)
    values (in_maTL, in_tenTL);
    
	select count(*) into count_exist from theloai where maTL = in_maTL;
    if count_exist > 0 then
        return true;
    else
        return false;
    end if;
end //
delimiter ;


delimiter //
drop function if exists xoaTL//
create function xoaTL(in_maTL char(10))
returns boolean
begin
    declare error_occurred int default 0;
    
    -- Kiểm tra ràng buộc trước khi xóa
    declare continue handler for sqlexception set error_occurred = 1;
    delete from theloai where maTL = in_maTL;
    
    -- Xử lý lỗi ràng buộc
    if error_occurred then
        return false;
    else
        return true;
    end if;
end //
delimiter ;


-- Sắp xếp tên thể loại
delimiter //
drop procedure if exists sapXepTL//
create procedure sapXepTL ()
begin
    select  *
    from theloai
    order by tenTL ASC;
end //
delimiter ;

-- Tìm kiếm sách bằng tên hoặc mã thể loại
delimiter //
drop procedure if exists timKiemTL//
create procedure timKiemTL
(
    in in_TL varchar(10)
)
begin
    select   *
    from theloai
    where  lower(tenTL) like concat('%', in_TL, '%')
    or lower(maTL) = lower(in_TL) ;
end //
delimiter ;

-- --------------------------------------------------------------------------------
-- Hiển thị NXB
delimiter //
drop procedure if exists hthiNXB//
create procedure hthiNXB ()
begin
    select *
    from nhaXuatBan;
end //
delimiter ;

-- hiển thị thông tin NXB với mã NXB tương được chọn
delimiter //
drop procedure if exists hthiThongTinNXB//
create procedure hthiThongTinNXB (in_maNXB char(10))
begin
    select *
    from  nhaXuatBan
    where maNXB = in_maNXB;
end //
delimiter ;

-- cập nhật NXB
delimiter //
drop function if exists capNhatNXB//
create function capNhatNXB(
    in_maNXB char(10),
    in_tenNXB varchar(50),
    in_diaChi varchar(100),
    in_email varchar(50),
    in_ttNguoiDaiDien varchar(255)
)
returns boolean
begin
	declare count_exist int ;
    -- Cập nhật thông tin NXB
    update nhaXuatBan
    set tenNXB = in_tenNXB, 
        diachi = in_diaChi, 
        email = in_email, 
        ttNguoiDaiDien = in_ttNguoiDaiDien
    where maNXB = in_maNXB;
    if row_count() > 0 then
        return true;
    else
        return false;
    end if;
end //
delimiter ;



-- Thêm NXB
delimiter //
drop function if exists themNXB//
create function themNXB(
    in_maNXB char(10),
    in_tenNXB varchar(50),
    in_diaChi varchar(100),
    in_email varchar(50),
    in_ttNguoiDaiDien varchar(255)
)
returns boolean
begin
	DECLARE count_exitst int ;
    
    select count(*) into count_exitst from nhaXuatBan where maNXB = in_maNXB;
	if count_exitst > 0 then
		return false;
    end if;
    
    -- Cập nhật thông tin NXB
    insert into nhaXuatBan (maNXB, tenNXB, diaChi, email, ttNguoiDaiDien)
    values (in_maNXB, in_tenNXB, in_diaChi, in_email,  in_ttNguoiDaiDien);
    
	select count(*) into count_exitst from nhaXuatBan where maNXB = in_maNXB;
	if count_exitst > 0 then
		return true;
    else
        return false;
    end if;
end //
delimiter ;


delimiter //
drop function if exists xoaNXB//
create function xoaNXB(in_maNXB char(10))
returns boolean
begin
    declare error_occurred int default 0;
    
    -- Kiểm tra ràng buộc trước khi xóa
    declare continue handler for sqlexception set error_occurred = 1;
    delete from nhaXuatBan where maNXB = in_maNXB;
    
    -- Xử lý lỗi ràng buộc
    if error_occurred then
        return false;
    else
        return true;
    end if;
end //
delimiter ;


-- Sắp xếp tên NXB
delimiter //
drop procedure if exists sapXepNXB//
create procedure sapXepNXB ()
begin
    select  *
    from nhaXuatBan
    order by tenNXB ASC;
end //
delimiter ;

-- Tìm kiếm NXB theo tên hoặc mã NXB
delimiter //
drop procedure if exists timKiemNXB//
create procedure timKiemNXB
(
    in in_NXB varchar(10)
)
begin
    select *
    from nhaXuatBan
    where  lower(tenNXB) like concat('%', in_NXB, '%')
    or lower(maNXB) = lower(in_NXB) ;
end //
delimiter ;

-- --------------------------------------------------------------------------------

-- Hiển thị nhân viên
delimiter //
drop procedure if exists hthiNV//
create procedure hthiNV ()
begin
    select *
    from nhanVien;
end //
delimiter ;

-- hiển thị thông tin nhân viên với mã tương đương được chọn
delimiter //
drop procedure if exists hthiThongTinNV//
create procedure hthiThongTinNV(in_maNV char(10))
begin
    select *
    from nhanVien
    where maNV = in_maNV;
end //
delimiter ;


-- cập nhật nhân viên
delimiter //
drop function if exists capNhatNV//
create function capNhatNV(
    in_maNV char(10),
    in_tenNV varchar(50),
    in_ngaySinh date,
    in_soDT int
)
returns boolean
begin
    
    update nhanVien
    set tenNV = in_tenNV, 
        ngaySinh = in_ngaySinh, 
        soDT = in_soDT
    where maNV = in_maNV;
    if row_count() > 0 then
        return true;
    else
        return false;
    end if;
end//
delimiter ;


-- Them  nhân viên
delimiter //
drop function if exists themNV//
create function themNV(
    in_maNV char(10),
    in_tenNV varchar(50),
    in_ngaySinh date,
    in_soDT int
)
returns boolean
begin
	DECLARE count_exitst int ;
    
    select count(*) into count_exitst from nhanVien where maNV = in_maNV;
	if count_exitst > 0 then
		return false;
    end if;
    
    -- Cập nhật thông tin NXB
    insert into nhanVien (maNV, tenNV, ngaySinh, SoDT)
    values (in_maNV, in_tenNV, in_ngaySinh, in_SoDT);
    
	select count(*) into count_exitst from nhanVien where maNV = in_maNV;
	if count_exitst > 0 then
		return true;
    else
        return false;
    end if;
end //
delimiter ;


delimiter //
drop function if exists xoaNV//
create function xoaNV(in_maNV char(10))
returns boolean
begin
    declare error_occurred int default 0;
    
    -- Kiểm tra ràng buộc trước khi xóa
    declare continue handler for sqlexception set error_occurred = 1;
    delete from nhanVien where maNV = in_maNV;
    
    -- Xử lý lỗi ràng buộc
    if error_occurred then
        return false;
    else
        return true;
    end if;
end //
delimiter ;


-- Sắp xếp tên nhân viên
delimiter //
drop procedure if exists sapXepNV//
create procedure sapXepNV()
begin
    select  *
    from nhanVien
    order by  tenNV ASC;
end //
delimiter ;

-- Tìm kiếm nhân viên bằng tên hoặc mã NV
delimiter //
drop procedure if exists timKiemNV//
create procedure timKiemNV
(
    in in_nhanvien varchar(10)
)
begin
    select  *
    from nhanVien
    where  lower(tenNV) like concat('%', in_nhanVien, '%')
    or lower(maNV) = lower(in_nhanVien) ;
end //
delimiter ;

-- --------------------------------------------------------------------------------
-- Thẻ thư viện
-- Hiển thị thẻ thư viện 
delimiter //
drop procedure if exists hthiTTV//
create procedure hthiTTV ()
begin
    select *
    from theThuVien;
end //
delimiter ;

-- hiển thị thông tin thẻ thư viện với so thẻ được chọn
delimiter //
drop procedure if exists hthiThongTinTTV//
create procedure hthiThongTinTTV (in_soThe char(10))
begin
    select *
    from theThuVien
    where soThe = in_soThe;
end //
delimiter ;

-- cập nhật thẻ thư viện 
delimiter //
drop function if exists capNhatTTV//
create function capNhatTTV(
    in_soThe char(10),
    in_ngayBD date,
    in_ngayKT date,
    in_ghiChu varchar(255)
)
returns boolean
begin
    -- Cập nhật thông tin  thẻ thư viện 
    declare count_exist int;
    
    if in_ngayBD > in_ngayKT then
		return false;
	end if;
    
    update theThuVien
    set ngayBD = in_ngayBD, 
        ngayKT = in_ngayKT, 
        ghiChu = in_ghiChu
    where soThe = in_soThe;
	if row_count() > 0 then
        return true;
    else
        return false;
    end if;
end//
delimiter ;


-- Them Thẻ thư viện
delimiter //
drop function if exists themTTV//
create function themTTV(
    in_soThe char(10),
    in_ngayBD date,
    in_ngayKT date,
    in_ghiChu varchar(255)
)
returns boolean
begin
	DECLARE count_exitst int ;
    -- Cập nhật thông tin thẻ thư viện 
    
    select count(*) into count_exitst from theThuVien where soThe = in_soThe;
	if count_exitst > 0 then
        return false;
    end if;
    
    if in_ngayBD > in_ngayKT then
		return false;
	end if;
    
    insert into theThuVien(soThe, ngayBD, ngayKT, ghiChu)
    values (in_soThe, in_ngayBD, in_ngayKT, in_ghiChu);
	select count(*) into count_exitst from theThuVien where soThe = in_soThe;
	if count_exitst > 0 then
        return true;
    else
        return false;
    end if;
end //
delimiter ;


delimiter //
drop function if exists xoaTTV//
create function xoaTTV(in_soThe char(10))
returns boolean
begin
    declare error_occurred int default 0;
    
    -- Kiểm tra ràng buộc trước khi xóa
    declare continue handler for sqlexception set error_occurred = 1;
    delete from theThuVien where soThe = in_soThe;
    
    -- Xử lý lỗi ràng buộc
    if error_occurred then
        return false;
    else
        return true;
    end if;
end //
delimiter ;


-- Sắp xếp ngày bd
delimiter //
drop procedure if exists sapXepTTV//
create procedure sapXepTTV ()
begin
    select *
    from theThuVien
    order by  ngayBD ASC;
end //
delimiter ;

-- Tìm kiếm sách bằng số thẻ
delimiter //
drop procedure if exists timKiemTTV//
create procedure timKiemTTV
(
    in in_the varchar(10)
)
begin
    select ttv.soThe, ttv.ngayBD, ttv.ngayKT, ttv.ghiChu
    from theThuVien ttv
    where lower(ttv.soThe) = lower(in_the) ;
end //
delimiter ;

-- ----------------------------------------------------------------------------------
-- độc giả
-- Hiển thi độc giả

delimiter //
drop procedure if exists hthiDG//
create procedure hthiDG ()
begin
    select *
    from docGia;
end //
delimiter ;

-- hiển thị thông tin độc giả với mã độc gia tương được chọn
delimiter //
drop procedure if exists hthiThongTinDG//
create procedure hthiThongTinDG (in_maDG char(10))
begin
    select *
    from docGia
    where maDG = in_maDG;
end //
delimiter ;

--- cập nhật độc giả
delimiter //
drop function if exists capNhatDG//
create function capNhatDG(
    in_maDG char(10),
    in_tenDG varchar(50),
    in_diaChi varchar(100),
    in_soThe char(10)
)
returns boolean
begin   
    declare count_exitst int ;
	
    select count(*) into count_exitst from docGia where maDG = in_maDG and soThe = in_soThe;
    if count_exitst = 0 then 
		select count(*) into count_exitst from theThuVien where soThe = in_soThe;
		if count_exitst = 0 then
			return false;
		end if;
		
		select count(*) into count_exitst from docGia where soThe = in_soThe;
		if count_exitst > 0 then
			return false;
		end if;
	end if;

    update docGia
    set tenDG = in_tenDG, 
        diaChi = in_diaChi, 
        soThe = in_soThe
    where maDG = in_maDG;
    if row_count() > 0 then
        return true;
    else
        return false;
    end if;
end//
delimiter ;



-- Them Độc giả
delimiter //
drop function if exists themDG//
create function themDG(
    in_maDG char(10),
    in_tenDG varchar(50),
    in_diaChi varchar(100),
    in_soThe char(10)
)
returns boolean
begin
	DECLARE count_exitst int ;
    select count(*) into count_exitst from docGia where maDG = in_maDG;
    if count_exitst > 0 then
        return false;
    end if;

    select count(*) into count_exitst from theThuVien where soThe = in_soThe;
    if count_exitst = 0 then
        return false;
    end if;
    
    select count(*) into count_exitst from docGia where soThe = in_soThe;
    if count_exitst > 0 then
        return false;
    end if;


    insert into docGia(maDG, tenDG, diaChi, soThe)
    values (in_maDG, in_tenDG, in_diaChi, in_soThe);

    select count(*) into count_exitst from docGia where maDG = in_maDG;
    if count_exitst > 0 then
        return true;
    else
        return false;
    end if;
end //
delimiter ;


delimiter //
drop function if exists xoaDG//
create function xoaDG(in_maDG char(10))
returns boolean
begin
    declare error_occurred int default 0;
    
    -- Kiểm tra ràng buộc trước khi xóa
    declare continue handler for sqlexception set error_occurred = 1;
    delete from docGia where maDG = in_maDG;
    
    -- Xử lý lỗi ràng buộc
    if error_occurred then
        return false;
    else
        return true;
    end if;
end //
delimiter ;


-- Sắp xếp tên độc giả
delimiter //
drop procedure if exists sapXepDG//
create procedure sapXepDG ()
begin
    select *
    from docGia
    order by tenDG  ASC;
end //
delimiter ;

-- Tìm kiếm  bằng tên đọc giả hoặc mã
delimiter //
drop procedure if exists timKiemDG//
create procedure timKiemDG
(
    in in_docgia varchar(10)
)
begin
    select *
    from docGia
    where  lower(tenDG) like concat('%', in_docgia, '%')
    or lower(maDG) = lower(in_docgia) ;
end //
delimiter ;



-- --------------------------------------------------------------------------------
-- Mượn trả
-- hiển thị mượn trả sách
delimiter //
drop procedure if exists hthiMuonTra//
create procedure hthiMuonTra ()
begin
    select mt.maMT, ctmt.maSach, mt.maNV, mt.soThe, mt.ngayMuon, ctmt.ngayTra, ctmt.daTra, ctmt.ghiChu
    from muonTra mt
    join CTMuonTra ctmt on mt.maMT = ctmt.maMT;
end //
delimiter ;

-- hiển thị thông tin mượn trả tương ứng với mã mượn trả và mã sách được chọn
delimiter //
drop procedure if exists hthiThongTinMuonTra//
create procedure hthiThongTinMuonTra(
	in_maMT char(10),
	in_maSach char(10)
    )
begin
    select mt.maNV, mt.soThe, mt.ngayMuon, ctmt.ngayTra, ctmt.ghiChu
    from muonTra mt
    join CTMuonTra ctmt on mt.maMT = ctmt.maMT
    where mt.maMT = in_maMT
    and ctmt.maSach = in_maSach;
end //
delimiter ;

-- cập nhật mượn trả sách
delimiter //
drop function if exists capNhatMuonTra//

create function capNhatMuonTra(
    in_maMT char(10),
    in_maSach char(10),
    in_maNV char(10),
    in_soThe char(10),
    in_ngayMuon date,
    in_ngayTra date,
    in_ghiChu varchar(255)
)
returns boolean
begin
    declare soTheTonTai int;
    declare maNVTonTai int;
    declare maSachTonTai int;
    declare v_daTra boolean default "0";

    -- Kiểm tra tồn tại số thẻ
    select count(*) into soTheTonTai from thethuvien where soThe = in_soThe;

    -- Kiểm tra tồn tại mã nhân viên
    select count(*) into maNVTonTai from nhanvien where maNV = in_maNV;
    
    -- Kiểm tra tồn tại mã sách
    select count(*) into maSachTonTai from sach where maSach = in_maSach;

    if soTheTonTai = 0 or maNVTonTai = 0 or maSachTonTai = 0 then
        return false;
    end if;

    if in_ngayTra is not null and in_ngayTra < in_ngayMuon then
		return false;
	end if;
    
    set v_daTra = (case when in_ngayTra is not null then "1" else "0" end);
    
    -- Cập nhật thông tin mượn trả sách
    update muonTra
    set soThe = in_soThe,
        maNV = in_maNV,
        ngayMuon = in_ngayMuon
    where maMT = in_maMT;

    update CTMuonTra
    set ngayTra = in_ngayTra,
        daTra = v_daTra,
        ghiChu = in_ghiChu
    where maMT = in_maMT
    and maSach = in_maSach;
    
	-- Kiểm tra số dòng bị ảnh hưởng để xác nhận cập nhật thành công
    return true;
end //

delimiter ;

-- thêm mượn trả sách
delimiter //
drop function if exists themMuonTra//
create function themMuonTra(
    in_maMT char(10),
    in_maSach char(10),
    in_maNV char(10),
    in_soThe char(10),
    in_ngayMuon date,
    in_ghiChu varchar(255)
)
returns boolean
begin
    declare soTheTonTai int;
    declare maNVTonTai int;
    declare maSachTonTai int;
    declare v_datra int default 0;

    -- Kiểm tra tồn tại số thẻ
    select count(*) into soTheTonTai from thethuvien where soThe = in_soThe;

    -- Kiểm tra tồn tại mã nhân viên
    select count(*) into maNVTonTai from nhanvien where maNV = in_maNV;
    
    -- Kiểm tra tồn tại mã sách
    select count(*) into maSachTonTai from sach where maSach = in_maSach;

    if soTheTonTai = 0 or maNVTonTai = 0 or maSachTonTai = 0 then
        return false;
    end if;

	select count(*) into v_datra from CTMuonTra where maSach = in_maSach and daTra = "0";
    if v_datra > 0 then
        return false;
    end if;
    
    -- Cập nhật thông tin mượn trả sách
    if not exists (select * from muonTra where maMT = in_maMT) then
		insert into muonTra (maMT, soThe, maNV, ngayMuon) value
			(in_maMT, in_soThe, in_maNV, in_ngayMuon);
	end if;

    insert into CTMuonTra (maMT, maSach, ghiChu, daTra, ngayTra) value
		(in_maMT, in_maSach, in_ghiChu, "0", null);

    return true;
end //

delimiter ;

-- Xóa mượn trả
delimiter //
drop function if exists xoaMuonTra//
create function xoaMuonTra(
	in_maMT char(10),
    in_maSach char(10)
    )
returns boolean
begin
	
    if not exists (select * from muonTra where maMT = in_maMT) then
        return false;
    end if;
    
    if not exists (select * from CTMuonTra where maMT = in_maMT and maSach = in_maSach) then
        return false;
    end if;
    
    delete from CTMuonTra where maMT = in_maMT and maSach = in_maSach;
    if not exists (select * from CTMuonTra where maMT = in_maMT) then
		delete from muonTra where maMT = in_maMT;
	end if;
    
	return true;

end //
delimiter ;

-- Sắp xếp theo ngày mượn từ xa đến gần
delimiter //
drop procedure if exists sapXepMuonTra//
create procedure sapXepMuonTra ()
begin
    select mt.maMT, ctmt.maSach, mt.maNV, mt.soThe, mt.ngayMuon, ctmt.ngayTra, ctmt.daTra, ctmt.ghiChu
    from muonTra mt
    join CTMuonTra ctmt on mt.maMT = ctmt.maMT
    order by mt.ngayMuon ASC;
end //
delimiter ;

-- Tìm kiếm mượn trả
delimiter //
drop procedure if exists timKiemMuonTra//
create procedure timKiemMuonTra
(
    in keyword varchar(10)
)
begin
    select mt.maMT, ctmt.maSach, mt.maNV, mt.soThe, mt.ngayMuon, ctmt.ngayTra, ctmt.daTra, ctmt.ghiChu
    from muonTra mt
    join CTMuonTra ctmt on mt.maMT = ctmt.maMT
    where  lower(mt.maMT) like keyword
    or lower(ctmt.maSach) like keyword
    or lower(mt.ngayMuon) = keyword
    or lower(ctmt.ngayTra) = keyword;
end //
delimiter ;
