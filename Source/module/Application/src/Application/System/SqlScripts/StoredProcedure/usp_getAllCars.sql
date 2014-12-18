-- Lấy danh sách xe theo hãng
--
-- usp_getAllCars 'FUTA'

Create Procedure usp_getAllCars
	@operator nchar(10)
As
Begin
	Select x.BangSoXe, loai.TenLoai, lich.NoiDi, lich.NoiDen, hang.TenHangXe
	From ((Xe x Join LoaiXe loai on x.LoaiXe = loai.MaLoai) Join LichTrinh lich on x.LichTrinh = lich.MaLT) Join HangXe hang on x.HangXe = hang.MaHangXe
	Where x.HangXe = @operator
End