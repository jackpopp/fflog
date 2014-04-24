showSection = (target) ->
	$('.js-show-section').each -> $(@).removeClass('active')
	target.addClass('active')
	if target.hasClass('js-new-post-a')
		$('.js-blog-settings').fadeOut(400, -> $('.js-edit-posts').fadeOut(400, -> $('.js-new-post').fadeIn()))

	if target.hasClass('js-blog-settings-a')
		$('.js-edit-posts').fadeOut(400, -> $('.js-new-post').fadeOut(400, -> $('.js-blog-settings').fadeIn()))

	if target.hasClass('js-edit-posts-a')
		$('.js-new-post').fadeOut(400, -> $('.js-blog-settings').fadeOut(400, -> $('.js-edit-posts').fadeIn()))
	return

$ ->
	
	#$('body').addClass('invisible')
	setTimeout(
		-> $('body').removeClass('invisible')
		50
	)

	
	setTimeout(
		-> $('.message').fadeOut(500, -> $('.message').remove())
		4000
	)

	$('textarea').css('overflow', 'hidden').autosize()

	$('.js-focus-input').focus()

	initVal = $('.js-focus-input').val()
	$('.js-focus-input').val('')
	$('.js-focus-input').val(initVal)

	$('.js-show-section').click (e) ->
		showSection($(e.target))
		e.preventDefault()
		return
