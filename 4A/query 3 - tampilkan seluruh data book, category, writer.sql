SELECT tb_book.id, tb_book.name AS name_book, tb_book.publication_year, tb_category.name AS name_category, tb_writer.name AS name_writer, tb_book.img
FROM tb_book
LEFT JOIN tb_category ON tb_book.category_id=tb_category.id
LEFT JOIN tb_writer ON tb_book.writer_id=tb_writer.id
