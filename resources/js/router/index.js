import Home from '../views/Home'
import About from '../views/About'
import NewPost from '../views/posts/Create'
import TableOfPost from '../views/posts/Table'
import ShowThePost from '../views/posts/Show'
import EditPost from '../views/posts/Edit'

export default {
    mode: 'history',
    linkActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/about',
            name: 'pages.about',
            component: About
        },
        {
            path: '/posts/create',
            name: 'posts.create',
            component: NewPost
        },
        {
            path: '/posts/table',
            name: 'posts.table',
            component: TableOfPost
        },
        {
            path: '/posts/:postSlug',
            name: 'posts.show',
            component: ShowThePost
        },
        {
            path: '/posts/:postSlug/edit',
            name: 'posts.edit',
            component: EditPost
        },
    ]
}
