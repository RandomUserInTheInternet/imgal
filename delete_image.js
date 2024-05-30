const faunadb = require('faunadb');
const q = faunadb.query;

exports.handler = async (event, context) => {
    const client = new faunadb.Client({ secret: 'your-fauna-secret' });

    const data = JSON.parse(event.body);
    const imageId = data.id;

    try {
        const response = await client.query(
            q.Delete(q.Ref(q.Collection('images'), imageId))
        );
        return {
            statusCode: 200,
            body: JSON.stringify(response),
        };
    } catch (error) {
        return {
            statusCode: 500,
            body: JSON.stringify({ error: error.message }),
        };
    }
};