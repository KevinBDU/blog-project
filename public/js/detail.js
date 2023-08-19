const replyTitle = document.querySelector('#commentForm > h3')
document.querySelectorAll("[data-reply]").forEach(element => {
    element.addEventListener("click", function () {
        const { id, author } = this.dataset
        document.querySelectorAll('.comment-item').forEach(comment => {
            const commentId = comment.dataset.id
            if (commentId !== id) {
                comment.style.opacity = 0.25
            } else {
                comment.style.opacity = 1
            }
        })
        document.querySelector("#comment_parentid").value = id;
        replyTitle.innerText = `Répondre à ${author}`
    })
})